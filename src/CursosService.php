<?php

namespace MoodleDownload;

class CursosService{

    private $wsBaseUrl = '/webservice/rest/server.php';

    public function __construct()
    {
        
    }

    public function getCursos(){
        $moodleSiteUrl = CookieService::getMoodleSiteUrl();
        $url = $moodleSiteUrl . $this->wsBaseUrl;
        $userId = CookieService::getUserid();
        if( !$userId ){
            $userId = $this->getUserid();
        }
        $res = HttpService::get( $url, [
            'wstoken' => CookieService::getToken(),
            'moodlewsrestformat' => 'json',
            'wsfunction' => 'core_enrol_get_users_courses',
            'userid' => $userId
        ]);
        return $res;
    }

    public function getContenidosCurso( string $idCurso ){
        $moodleSiteUrl = CookieService::getMoodleSiteUrl();
        $url = $moodleSiteUrl . $this->wsBaseUrl;
        $res = HttpService::get( $url, [
            'wstoken' => CookieService::getToken(),
            'moodlewsrestformat' => 'json',
            'wsfunction' => 'core_course_get_contents',
            'courseid' => $idCurso
        ]);
        return $res;
    }

    private function getUserid(){
        $moodleSiteUrl = CookieService::getMoodleSiteUrl();
        $url = $moodleSiteUrl . $this->wsBaseUrl;
        $res = HttpService::get( $url, [
            'wstoken' => CookieService::getToken(),
            'moodlewsrestformat' => 'json',
            'wsfunction' => 'core_webservice_get_site_info'
        ]);
        $userId = $res->userid;
        CookieService::setUserid($userId);
        return $userId;
    }

}