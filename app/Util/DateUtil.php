<?php

namespace App\Util;

use Carbon\Carbon;

class DateUtil
{
    public static function dateLess($date)
    {
        if (!$date) {
            return;
        }
        $date = new Carbon($date);

        return $date->format('d ').self::month($date->format('m'), 'less').$date->format(' Y');
    }

    public static function dateFull($date)
    {
        if (!$date) {
            return;
        }
        $date = new Carbon($date);

        return $date->format('d ').self::month($date->format('m'), 'full').$date->format(' Y');
    }

    public static function dateTimeFull($date)
    {
        if (!$date) {
            return;
        }
        $date = new Carbon($date);

        return $date->format('d ').self::month($date->format('m'), 'full').$date->format(' Y').', '.$date->format('H:i');
    }

    private static function month($month, $type = 'less')
    {
        if (1 == strlen($month)) {
            $month = '0'.$month;
        }
        $month = (string) $month;
        $array = [
            '01' => 'Ocak',
            '02' => 'Şubat',
            '03' => 'Mart',
            '04' => 'Nisan',
            '05' => 'Mayıs',
            '06' => 'Haziran',
            '07' => 'Temmuz',
            '08' => 'Ağustos',
            '09' => 'Eylül',
            '10' => 'Ekim',
            '11' => 'Kasım',
            '12' => 'Aralık',
        ];
        if ('less' === $type) {
            $array = [
                '01' => 'Ock',
                '02' => 'Şbt',
                '03' => 'Mrt',
                '04' => 'Nis',
                '05' => 'May',
                '06' => 'Hzr',
                '07' => 'Tmz',
                '08' => 'Ağs',
                '09' => 'Eyl',
                '10' => 'Ekm',
                '11' => 'Kas',
                '12' => 'Ar',
            ];
        }

        return $array[$month];
    }
}
