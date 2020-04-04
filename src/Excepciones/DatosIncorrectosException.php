<?php

namespace MoodleDownload\Excepciones;

use Exception;

class DatosIncorrectosException extends Exception{

    public function __construct( $msg = 'La url, usuario o contraseña son incorrectos.' )
    {
        parent::__construct( $msg );
    }

}