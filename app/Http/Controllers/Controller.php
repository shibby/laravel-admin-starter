<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Shibby\Loilerplate\Controller\BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $parameters = [
        'siteTitle' => 'Admin',
        'siteDescription' => 'Admin',
        'pageTitle' => '',
        'siteKeywords' => null,
    ];

    protected $og = [
        'type' => '',
        'title' => '',
        'image' => null,
        'url' => '',
        'video' => '',
    ];

    protected function setTitle($title)
    {
        $this->setOg('title', $title);
        parent::setTitle($title);
    }

    protected function setKeywords($title)
    {
        $this->parameters['siteKeywords'] = $title;
    }

    protected function setOg($type, $content)
    {
        if ('image' === $type) {
            $this->og['image'][] = $content;
        } else {
            $this->og[$type] = $content;
        }
    }

    protected function addBreadcrumb($url, $text = '', $icon = '')
    {
        if ($text) {
            //$text = ucwords(strtolower($text));
        }
        if (!array_key_exists('breadcrumbs', $this->parameters)) {
            parent::addBreadcrumb(route('homepage'), 'Anasayfa', '');
        }

        return parent::addBreadcrumb($url, $text, $icon);
    }

    public function renderView($view, $params = [])
    {
        return parent::renderView($view, $params);
    }
}
