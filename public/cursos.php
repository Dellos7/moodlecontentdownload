<?php

error_reporting(E_ERROR);
$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

use MoodleDownload\CursosService;

include "html/header.html";

?>

<h2>Cursos</h2>

<?php
    try{
        $cursosSvc = new CursosService();
        $cursos = $cursosSvc->getCursos();
    } catch( Exception $e ){
        echo $e->getMessage() . "\n";
        header( "Location: index.php" );
    }
?>

<?php foreach($cursos as $curso){?>
    <h3><a href="curso.php?id=<?=$curso->id?>&nombre=<?=$curso->displayname?>"><span class="overline"><?=$curso->shortname?></span>. <?=$curso->displayname?></a></h3>
<?php }?>