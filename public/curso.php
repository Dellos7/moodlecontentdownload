<?php

use MoodleDownload\CookieService;
use MoodleDownload\CursosService;

error_reporting(E_ERROR);
$dir = dirname( __DIR__ );
require_once $dir . '/vendor/autoload.php';

$idCurso = $_GET['id'];
$nombreCurso = $_GET['nombre'];
$token = CookieService::getToken();

if( !$idCurso ){
    header( "Location: cursos.php" );
}

include "html/header.html";

$modulosDescargables = [ 'resource', 'url' ];
$extensionesUrlsDescargables = [ '.pdf', '.doc', '.docx', '.odt', '.ods', '.zip', '.rar', '.tar' ];
$cursosSvc = new CursosService();
$contenidoCurso = $cursosSvc->getContenidosCurso( $idCurso );

session_start();

function generarUrlsSeccion( $seccion ){
    global $token;
    $json = [];
    if( $seccion->modules ){
        foreach( $seccion->modules as $mod ){
            switch( $mod->modname ){
                case "resource":
                    if( $mod->contents ){
                        foreach( $mod->contents as $content ){
                            $json[] = [ "resource", $content->filename, $content->fileurl . "&token=" . $token ];
                        }
                    }
                    break;
                case "url":
                    if( $mod->contents ){
                        foreach( $mod->contents as $content ){
                            $json[] = [ "url", basename( $content->fileurl ), $content->fileurl ];
                        }
                    }
                    break;
                case "folder":
                    if( $mod->contents ){
                        $folder = generarUrlsCarpeta( $mod );
                        $json[] = [ "folder", $mod->name, $folder ];
                    }
                    break;
            }
        }
    }
    $_SESSION['seccion-' . $seccion->id] = urlencode( serialize( $json ) );
    return $json;
}

function generarUrlsCarpeta( $carpeta ){
    global $token;
    $json = [];
    if( $carpeta->contents ){
        foreach( $carpeta->contents as $content ){
            $json[] = [ "resource", $content->filename, $content->fileurl . "&token=" . $token, $content->filepath ];
        }
    }
    $_SESSION['carpeta-' . $carpeta->id] = urlencode( serialize( $json ) );
    return $json;
}

function comprobarSeccionDescargable( $seccion ){
    global $modulosDescargables;
    global $extensionesUrlsDescargables;
    $descargable = false;
    if($seccion->modules){
        foreach( $seccion->modules as $modulo ){
            $ext = true;
            if( $modulo->modname == 'url' ){
                // Comprobar si la extensión del archivo es descargable
                foreach( $extensionesUrlsDescargables as $extension ){
                    $ext &= strpos( $modulo->contents[0]->fileurl, $extension );
                    if( $ext ){
                        break;
                    }
                }
            }
            $descargable |= ( in_array( $modulo->modname, $modulosDescargables ) && $ext );
            if( $modulo->modname == 'folder' ){
                $descargable = comprobarCarpetaDescargable( $modulo );
            }
            if( $descargable ){
                break;
            }
        }
    }
    return $descargable;
}

function comprobarCarpetaDescargable( $carpeta ){
    $descargable = false;
    if( $carpeta->contents ){
        foreach( $carpeta->contents as $content ){
            if( $content->type == 'file' ){
                $descargable = true;
                break;
            }
        }
    }
    return $descargable;
}

?>
<h2><?=$nombreCurso?></h2>
<div class="descargar-curso-completo">
    <form id="descargar-curso-completo" method="post" action="downloadzip.php">
        <div class="form__linea">
            <input type="hidden" name="tipoDescarga" value="curso">
            <input type="hidden" name="nombreCurso" value="<?=$nombreCurso?>">
            <button type="submit">Descargar curso completo</button>
        </div>
    </form>
</div>
<?php
foreach( $contenidoCurso as $seccion ){
?>
    <div class="seccion">
        <div class="seccion__titulo-wrapper">
            <h3><?=$seccion->name?></h3>
            <?php
                $descargable = comprobarSeccionDescargable( $seccion );
                if( $descargable ){
                    generarUrlsSeccion($seccion);
                    ?>
                    <form id="form-<?=$seccion->id?>" class="form__descargar" method="post" action="downloadzip.php">
                        <input type="hidden" name="tipoDescarga" value="seccion">
                        <input type="hidden" name="idSeccion" value="<?=$seccion->id?>">
                        <input type="hidden" name="nombreSeccion" value="<?=$seccion->name?>">
                        <label><a onclick="document.getElementById('form-<?=$seccion->id?>').submit();">Descargar sección</a></label>
                    </form>
                <?php
                }
                ?>
        </div>
            <?php
            if( $seccion->modules ){
                foreach( $seccion->modules as $modulo ){
        ?>
            <div class="seccion__item">
                <img src="<?=$modulo->modicon?>" width="20px" height="20px">
                <?php switch($modulo->modname){
                    case "resource":?>
                        <label><a href="<?=$modulo->contents[0]->fileurl?>&token=<?=$token?>" target="_blank"><?=$modulo->name?></a></label>
                        <?php break;
                    case "url":?>
                        <label><a href="<?=$modulo->contents[0]->fileurl?>" target="_blank"><?=$modulo->name?></a></label>
                        <?php break;
                    case "folder":
                        if( comprobarCarpetaDescargable($modulo) ){
                            generarUrlsCarpeta( $modulo );
                        }
                    ?>
                        <label><?=$modulo->name?></label>
                        <form id="form-mod-<?=$modulo->id?>" class="form__descargar" method="post" action="downloadzip.php">
                            <input type="hidden" name="tipoDescarga" value="carpeta">
                            <input type="hidden" name="idCarpeta" value="<?=$modulo->id?>">
                            <input type="hidden" name="nombreCarpeta" value="<?=$modulo->name?>">
                            <label><a class="seccion__item-descargar" onclick="document.getElementById('form-mod-<?=$modulo->id?>').submit();">Descargar carpeta</a></label>
                        </form>
                        <?php break;
                    case "":?>
                        <?php break;
                    case "":?>
                        <?php break;
                    case "":?>
                    <?php break;
                    default:?>
                        <label><?=$modulo->name?></label>
                <?php }?>
            </div>
        <?php }}?>
        </div>
<?php }?>