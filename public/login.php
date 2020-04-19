<?php

error_reporting(E_ERROR);

// No entiendo por qué esto es necesario otra vez
$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

use MoodleDownload\CookieService;
use MoodleDownload\Excepciones\DatosIncorrectosException;
use MoodleDownload\LoginService;
use MoodleDownload\MoodleSiteData;

$url = $_POST['moodle-base-url'];
$username = $_POST['moodle-usuario'];
$password = $_POST['moodle-password'];
$moodleSiteData = new MoodleSiteData( $url, $username, $password );
CookieService::setMoodleSiteUrl( $moodleSiteData->url );

$loginSvc = new LoginService();
try{
    $token = $loginSvc->login($moodleSiteData);
    if( $token ){
        CookieService::removeUserid();
        CookieService::setToken( $token );
        header( "Location: index.php" );
    }
} catch( DatosIncorrectosException $e ){
    include "html/header.html";
    echo "<p class='datos-incorrectos'>" . $e->getMessage() . "</p>";
    echo <<<EOF
<form method="GET" action="index.php">
    <div class="form__linea">
        <button type="submit">Volver</button>
    </div>
</form>
EOF;
    include "html/footer.html";
}