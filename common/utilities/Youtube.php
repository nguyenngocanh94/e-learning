<?php


namespace common\utilities;


class Youtube
{
    public static function getId($url){
        $youtubeId = [];
        parse_str( parse_url( $url, PHP_URL_QUERY ), $youtubeId );

        if (count($youtubeId) > 0){
            return $youtubeId['v'];
        }
        return "wrong youtube link";
    }
}