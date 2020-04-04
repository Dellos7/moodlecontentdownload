<?php

use MoodleDownload\CookieService;

error_reporting(E_ERROR);

$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

include "html/header.html";

?>

    <?php if( !CookieService::getToken() ){?>
        <div class="login-form-wrapper">
            <form class="login-form" method="POST" action="login.php">
                <div class="form__linea">
                    <label for="moodle-base-url">Moodle URL:</label>
                </div>
                <div class="form__linea">
                    <input type="url" name="moodle-base-url" id="moodle-base-url" required>
                </div>
                <div class="form__linea">
                    <label for="moodle-base-url">Usuario:</label>
                    <input type="text" name="moodle-usuario" id="moodle-usuario" required>
                </div>
                <div class="form__linea">
                    <label for="moodle-base-url">Contraseña:</label>
                    <input type="password" name="moodle-password" id="moodle-password" required>
                </div>
                <div class="form__linea">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    <?php
    }else{
        header( "Location: cursos.php" );
    }
    ?>

<?php
include "html/footer.html";
?>