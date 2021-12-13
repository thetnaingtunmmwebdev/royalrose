<?php

namespace Helpers;

class HTTP
{
    static $base = "http://192.168.1.8/royalrose";

    static function redirect($path, $query = "")
    {
        $url = static::$base . $path;
        if($query) $url .= "?$query";

        header("location: $url");
        exit();
    }
}