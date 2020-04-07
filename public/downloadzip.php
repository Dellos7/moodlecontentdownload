<?php

ob_start();
//error_reporting(E_ERROR);

$zipTmpDir = dirname( __DIR__ ) . '/zips';

function generarHash(){
    return bin2hex( random_bytes( 16 ) );
}

function crearZip( $nombre ){
    global $zipTmpDir;
    $zip = new ZipArchive();
    $zip->open( $zipTmpDir . "/" . $nombre, ZipArchive::CREATE );
    if( !is_dir( $zipTmpDir ) ){
        mkdir( $zipTmpDir, 0755 );
    }
    return $zip;
}

function generarZipCarpeta( $urls ){
    $hash = generarHash() . ".zip";
    $zip = crearZip( $hash );
    $zipSubdirs = [];
    foreach( $urls as $urlData ){
        $filename = $urlData[1];
        $url = $urlData[2];
        $subfolder = $urlData[3];
        if( $subfolder && $subfolder != '/' && !in_array( $subfolder, $zipSubdirs ) ){
            $zip->addEmptyDir( substr( $subfolder, 1 ) );
            $zipSubdirs[] = $subfolder;
        }
        $file = file_get_contents( $url );
        $zip->addFromString( substr( $subfolder, 1 ) . $filename, $file );
    }
    $zip->close();
    return $hash;
}

function generarZipSeccion( $urls ){
    global $zipTmpDir;
    $hash = generarHash() . ".zip";
    $zip = crearZip( $hash );
    foreach( $urls as $urlData ){
        $tipo = $urlData[0];
        if( $tipo == 'folder' ){
            $folderZip = generarZipCarpeta( $urlData[2] );
            $folderZipFile = file_get_contents( $zipTmpDir . "/" . $folderZip );
            $zip->addFromString( $urlData[1] . ".zip", $folderZipFile );
            unlink( $zipTmpDir . "/" . $folderZip ); // Eliminamos el zip
        } else{
            $filename = $urlData[1];
            $url = $urlData[2];
            $file = file_get_contents( $url );
            $zip->addFromString( $filename, $file );
        }
    }
    $zip->close();
    return $hash;
}

function generarZipCursoCompleto(){
    global $zipTmpDir;
    $hash = generarHash() . ".zip";
    $zip = crearZip( $hash );
    foreach( $_SESSION as $key=>$value ){
        if( strpos( $key, 'seccion-' ) !== false ){
            $datosSeccion = unserialize( urldecode( $value ) );
            $seccionZip = generarZipSeccion( $datosSeccion );
            $seccionZipFile = file_get_contents( $zipTmpDir . "/" . $seccionZip );
            //TODO: cambiar el nombre de la sección
            $zip->addFromString( $key . ".zip", $seccionZipFile );
            unlink( $zipTmpDir . "/" . $seccionZip ); // Eliminamos el zip
        }
    }
    $zip->close();
    return $hash;
}

function descargarZip( $zipDir, $nombreZip, $nombreZipDescarga ){
    header( "Content-Type: application/zip" );
    header( "Content-Disposition: attachment; filename={$nombreZipDescarga}.zip" );
    header( "Content-Length: " . filesize( $nombreZip ) );
    // Las siguientes 2 líneas son necesarias, si no el zip queda corrupto
    ob_clean();
    flush();
    readfile( "{$zipDir}/{$nombreZip}" ); // Descargar el archivo
    unlink( $zipDir . "/" . $nombreZip ); // Eliminarlo
}


session_start();
$tipoDescarga = $_POST['tipoDescarga'];

switch( $tipoDescarga ){
    case "curso":
        $nombreCurso = $_POST['nombreCurso'];
        $nombreZip = generarZipCursoCompleto();
        descargarZip( $zipTmpDir, $nombreZip, $nombreCurso );
        break;
    case "seccion":
        $idSeccion = $_POST['idSeccion'];
        $nombreSeccion = $_POST['nombreSeccion'];
        $urls = unserialize( urldecode( $_SESSION['seccion-' . $idSeccion] ) );
        $nombreZip = generarZipSeccion( $urls );
        descargarZip( $zipTmpDir, $nombreZip, $nombreSeccion );
        break;
    case "carpeta":
        $idCarpeta = $_POST['idCarpeta'];
        $nombreCarpeta = $_POST['nombreCarpeta'];
        $urls = unserialize( urldecode( $_SESSION['carpeta-' . $idCarpeta] ) );
        $nombreZip = generarZipCarpeta( $urls );
        descargarZip( $zipTmpDir, $nombreZip, $nombreCarpeta );
        break;
    default:
        echo "Parámetros inválidos\n";
}