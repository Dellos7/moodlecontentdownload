<?php

use MoodleDownload\CursosService;

error_reporting(E_ERROR);
$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

$idCurso = $_GET['id'];
$nombreCurso = $_GET['nombre'];

if( !$idCurso ){
    header( "Location: cursos.php" );
}

include "html/header.html";

$modulosDescargables = [ 'resource' ];
$cursosSvc = new CursosService();
$contenidoCurso = $cursosSvc->getContenidosCurso( $idCurso );
//print_r($contenidoCurso);

?>
<h2><?=$nombreCurso?></h2>
<?php
foreach( $contenidoCurso as $seccion ){
?>
    <div class="seccion">
        <h3><?=$seccion->name?></h3>
        <?php
            if($seccion->modules){
                foreach( $seccion->modules as $modulo ){
                    $descargable = in_array( $modulo->modname, $modulosDescargables );
        ?>
            <div class="seccion__item">
                <img src="<?=$modulo->modicon?>" width="20px" height="20px">
                <label><?=$modulo->name?></label>
            </div>
        <?php }}?>
    </div>
<?php }?>