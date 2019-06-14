<?php

//if (!function_exists('setting')) {
//    function setting($key, $default = null)
//    {
//        return TCG\Voyager\Facades\Voyager::setting($key, $default);
//    }
//}

if (!function_exists('rus2translit')) {
    function rus2translit($text)
    {
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' '
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya', '_'
        ];

        return str_replace($cyr, $lat, $text);
    }
}

if (!function_exists('findLinks')) {
    function findLinks($text) {
        $regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
        return preg_replace_callback($regex, function ($matches) {
            return '<a target="_blank" href="' . $matches[0] . '">' . $matches[0] . '</a>';
        }, $text);
    }
}

if (!function_exists('daysFormat')) {
    function daysFormat($day) {
        $a = substr($day, strlen($day) - 1, 1);
        if ($a == 1) $str = "день";
        if ($a == 2 || $a == 3 || $a == 4) $str = "дня";
        if ($a == 5 || $a == 6 || $a == 7 || $a == 8 || $a == 9 || $a == 0) $str = "дней";
        return $str;
    }
}
