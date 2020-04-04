<?php

namespace MoodleDownload;

use MoodleDownload\Excepciones\DatosIncorrectosException;

class LoginService{

    private $loginUrl = '/login/token.php';
    public $token;

    public function __construct( string $token = null ){
        $this->token = $token;
    }

    public function login( MoodleSiteData $data ){
        $url = $data->url . $this->loginUrl;
        $res = HttpService::get( $url, [
            'username' => $data->username,
            'password' => $data->password,
            'service' => 'moodle_mobile_app'
        ]);
        if( !$res ){
            throw new DatosIncorrectosException();
        }
        $this->token = $res->token;
        return $this->token;
    }

}