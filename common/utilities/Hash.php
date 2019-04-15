<?php


namespace common\utilities;


class Hash
{
    public static function hash($need){
        $now = date('Ymd his');
        return md5($need.$now);
    }
}