<?php

$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

use MoodleDownload\CookieService;

CookieService::removeToken();
unset($GLOBALS['moodleSiteData']);

header( "Location: index.php" );