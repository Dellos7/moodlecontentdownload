<?php

namespace MoodleDownload;

class MoodleSiteData{

    public $url;
    public $username;
    public $password;

    public function __construct( string $url, string $username, string $password ){
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
    }

}