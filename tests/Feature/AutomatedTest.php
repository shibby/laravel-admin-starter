<?php

namespace Tests\Feature;

use DOMDocument;
use Tests\TestCase;

class AutomatedTest extends TestCase
{
    private $bulkUrls = [];

    public function testAnon()
    {
        $client = $this->get('/');
        $client->assertStatus(200);
        $response = $client->baseResponse->getContent();
        $this->checkAllLinks($response);
    }

    private function checkAllLinks($html)
    {
        $skipLinks = [
            '/logout',
            '/tarif-defterim',
            '/yemek-tarifleri/tarif-gonder',
        ];
        $links = $this->getLinksFromHtml($html);

        foreach ($links as $url) {
            $req = $this->get($url);
            if (in_array($url, $skipLinks, false)) {
                continue;
            }
            if (str_contains($url, ['giris-yap', 'login'])) {
                continue;
            }

            $this->assertEquals(200, $req->baseResponse->status(), $url);
            $this->checkAllLinks($req->baseResponse->content());
        }
    }

    public function getLinksFromHtml($html)
    {
        $dom = new DOMDocument();

        @$dom->loadHTML($html);

        $urls = [];
        $links = $dom->getElementsByTagName('a');
        foreach ($links as $link) {
            $url = $link->getAttribute('href');
            if (starts_with($url, config('app.url'))) {
                $url = str_replace(config('app.url'), '', $url);
                if (!in_array($url, $this->bulkUrls, true)) {
                    $this->bulkUrls[] = $url;
                    $urls[] = $url;
                }
            }
        }

        return $urls;
    }
}
