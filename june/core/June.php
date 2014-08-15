<?php

class June {

    /**
     * Get version of June
     *
     * @return string
     */
    public static function version()
    {
        return 'June v4.0.1';
    }

    /**
     * Get public url
     *
     * @param $path
     * @return string
     */
    public static function asset($path)
    {
        return asset('public/' . $path);
    }

    /**
     * Get cloud public url
     *
     * @param $path
     * @return string
     */
    public static function cloudAsset($path)
    {
        return asset('app/cloud/public/' . $path);
    }
} 