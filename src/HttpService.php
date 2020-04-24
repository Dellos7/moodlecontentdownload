<?php

namespace MoodleDownload;

class HttpService{

    public static function get( string $url, array $params ){
        if( $params ){
            $url .= '?';
            foreach( $params as $paramName=>$paramValue ){
                $paramValue = urlencode($paramValue);
                $url .= "&{$paramName}={$paramValue}";
            }
        }
        $res = file_get_contents( $url );
        if( !$res ){
            return $res;
        }
        return json_decode($res);
    }

}