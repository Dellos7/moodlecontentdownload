<?php

namespace MoodleDownload;

class CookieService{

    private static $token;
    private static $moodleSiteUrl;
    private static $userId;

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

    public static function getMoodleSiteUrl(){
        if( !self::$moodleSiteUrl ){
            self::$moodleSiteUrl = $_COOKIE['moodleSiteUrl'];
        }
        return self::$moodleSiteUrl;
    }

    public static function setMoodleSiteUrl( string $url ){
        setcookie( 'moodleSiteUrl', $url, time() + 60*60*24*30 );
        self::$moodleSiteUrl = $url;
    }

    public static function removeMoodleSiteUrl(){
        setcookie( 'moodleSiteUrl', null, 0 );
        self::$moodleSiteUrl = null;
    }

    public static function getUserid(){
        if( !self::$userId ){
            self::$userId = $_COOKIE['userId'];
        }
        return self::$userId;
    }

    public static function setUserid( string $userId ){
        setcookie( 'userId', $userId, time() + 60*60*24*30 );
        self::$userId = $userId;
    }

    public static function removeUserid(){
        setcookie( 'userId', null, 0 );
        self::$userId = null;
    }

}