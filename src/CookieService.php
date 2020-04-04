<?php

namespace MoodleDownload;

class CookieService{

    private static $token;

    public static function getToken(){
        if( !self::$token ){
            self::$token = $_COOKIE['token'];
        }
        return self::$token;
    }

    public static function setToken( string $token ){
        setcookie( 'token', $token, time() + 60*60*24*30 );
        self::$token = $token;
    }

    public static function removeToken(){
        setcookie( 'token', null, 0 );
        self::$token = null;
    }

}