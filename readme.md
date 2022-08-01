# Descargar aula virtual Moodle

Aplicación web escrita en PHP que permite descargar todos los contenidos de un aula virtual de Moodle con un solo clic!

Lo que hace es conectarse a un aula virtual de Moddle utilizando las credenciales del usuario y permite descargar el curso completo en un archivo comprimido (.zip) o bien descargar de forma selectiva secciones, archivos o carpetas de cada una de las secciones.

## Requisitos

Debemos tener instalado:

- [Git](https://git-scm.com/). Si descargamos el proyecto utilizando `git clone`
- PHP 7 (ej. con [XAMPP](https://www.apachefriends.org/es/index.html))
- [Composer](https://getcomposer.org/)

## Instalación en Windows

En Windows podemos instalar PHP y Composer de forma sencilla de la siguiente manera:
1. Descargamos la última versión de PHP desde [está página](https://windows.php.net/download) en formato **Zip**.
2. Descomprimimos el archivo y lo colocamos en un directorio de donde no lo moveremos (por ejemplo, en `C:\php\php-8.0.21-Win32-vs16-x64` -> el archivo `php.exe` debe estar en esta ruta)
3. Añadimos la anterior ruta a la variable de entorno `PATH` del sistema. Para ello, debemos:
   - Ir al panel de control de Windows y en el buscador introducir `variables` y hacer clic donde dice **Editar las variables de entorno del sistema**.

![Panel de control](https://i.imgur.com/qcoCzE8.png)

   - A continuación, hacemos clic debajo en `Variables de entorno`
   - Sobre la variable **Path** hacemos clic en **Editar** y añadimos en una nueva línea la ruta anterior (en mi caso, `C:\php\php-8.0.21-Win32-vs16-x64`)
   
Ya tenemos PHP instalado.

Para **instalar composer**, simplemente descargamos el instalador para Windows desde [esta página](https://getcomposer.org/download/), lo ejecutamos y hacemos clic en **Siguiente** hasta finalizar.
   

## Descargar la aplicación y ejecutarla

1. Descargar el [archivo .zip](https://github.com/Dellos7/moodlecontentdownload/archive/refs/heads/master.zip) de este proyecto de Github o bien ejecutar: `git clone https://github.com/Dellos7/moodlecontentdownload.git`
2. Con una terminal nos situamos dentro de la carpeta del proyecto (*en Windows esto se haría abriendo el programa llamado **Símbolo del sistema***). Por ejemplo, si la ruta de la carpeta de mi proyecto es `C:\Users\David\Documents\moodlecontentdownload-master` debo ejecutar en la terminal: `cd C:\Users\David\Documents\moodlecontentdownload-master`
3. Dentro de la carpeta del proyecto ejecutar Composer: `composer install`
4. Lanzar servidor local desplegando la carpeta **public**:  `php -S localhost:8080 -t public/` 

Ahora, en un navegador abrir la url [http://localhost:8080](http://localhost:8080), introducir la **URL raíz** (NO la del curso) del aula virtual donde está el moodle del curso que queremos descargar, usuario y contraseña.

## Ejemplo de funcionamiento y uso

[![Mira el vídeo](https://img.youtube.com/vi/Q5XmedD5WZc/hqdefault.jpg)](https://youtu.be/Q5XmedD5WZc)

### Notas importantes

* En el campo de URL se debe introducir la **URL a la página raíz del moodle** (NO la del curso) que se desea descargar
* Sólo funcionará para aquellos moodle que tengan habilitados los servicios web para la app del móvil y los servicios REST
    * [Habilitar servicios web móviles en Moodle](https://docs.moodle.org/all/es/Servicios_web_m%C3%B3viles)
    * [Habilitar el protocolo REST en Moodle](https://docs.moodle.org/34/en/Using_web_services#Enabling_protocols)
