<?php

$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

use MoodleDownload\CookieService;

CookieService::removeToken();

header( "Location: index.php" );