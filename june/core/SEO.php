<?php
/**
 * Created by PhpStorm.
 * User: vuong
 * Date: 7/29/14
 * Time: 3:11 AM
 */

class SEO {

    private static $needed = array('title','description','keyword');
    private static $title = '';
    private static $description = '';
    private static $keyword = '';
    public static function init($arr = array())
    {
        foreach($arr as $k => $item){
            if(in_array($k,self::$needed)){
                self::${$k}= $item;
            }
        }
    }
    public static function title()
    {
        echo self::$title;
    }
    public static function description()
    {
        echo self::$description;
    }
    public static function keyword()
    {
        echo self::$keyword;
    }
} 