<?php

class June {

    public static function version()
    {
        return 'June v4.0.1';
    }

    public static function asset($path)
    {
        return asset('public/' . $path);
    }
    public static function cloudAsset($path)
    {
        return asset('app/cloud/public/' . $path);
    }
} 