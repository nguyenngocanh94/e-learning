<?php


namespace common\utilities;


class Time
{
    /**
     * return NOW
     * @return false|string
     */
    public static function Now(){
        return date('Y-m-d h:i:s');
    }
}