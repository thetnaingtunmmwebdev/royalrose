<?php

namespace Helpers;

class HTTP
{
    static $base = "http://192.168.11.254/rr";

    static function redirect($path, $query = "")
    {
        $url = static::$base . $path;
        if($query) $url .= "?$query";

        header("location: $url");
        exit();
    }
}