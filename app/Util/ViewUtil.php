<?php

namespace App\Util;

class ViewUtil
{
    public static function printAds($key, $adsList = null)
    {
        if (null === $adsList) {
            $adsList = \Cache::get('advertisement_list');
        }

        $ads = $adsList[$key] ?? null;
        if (null === $ads) {
            return;
        }

        if (trim($ads['ads_html'])) {
            return $ads['ads_html'];
        }
    }
}
