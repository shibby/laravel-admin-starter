<?php

namespace App\Util;

class StringUtil
{
    public static function slug($string, $sep)
    {
        $string = str_replace(
            ['ı', 'ş', 'ö', 'ç', 'ğ', 'ü', 'Ğ', 'Ş', 'Ö', 'Ü', 'İ', 'Ç'],
            ['i', 's', 'o', 'c', 'g', 'u', 'G', 'S', 'O', 'U', 'I', 'C'],
            $string
        );

        return str_slug($string, $sep);
    }

    public static function colors($i)
    {
        $array = [
            'yellow',
            'green',
            'blue',
            'purple',
            'pink',
            'red',
            'orange',
        ];

        return @$array[$i];
    }

    public static function escapeTirnak($string)
    {
        return str_replace('"', '\"', $string);
    }

    public static function phoneNumber($number)
    {
        $number = str_replace([
            '+',
            '(',
            ')',
            '-',
            '_',
            ' ',
        ], '', $number);

        return substr($number, 0, 11);
    }
}
