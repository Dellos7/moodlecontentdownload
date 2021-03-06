# Descargar aula virtual Moodle

Aplicación web escrita en PHP que permite conectarse a un aula virtual de Moddle y descargar el curso completo en un archivo comprimido (.zip) o bien descargar de forma selectiva secciones, archivos o carpetas de cada una de las secciones.

## Requisitos

Debemos tener instalado:

- [Git](https://git-scm.com/). Si descargamos el proyecto utilizando `git clone`
- PHP 7 (ej. con [XAMPP](https://www.apachefriends.org/es/index.html))
- [Composer](https://getcomposer.org/)

## Descargar e instalar

1. Descargar el .zip de este proyecto de Github o bien ejecutar: `git clone https://github.com/Dellos7/moodlecontentdownload.git`
2. Dentro de la carpeta del proyecto ejecutar Composer: `composer install`
3. Lanzar servidor local desplegando la carpeta **public**:  `php -S localhost:8080 -t public/`

Ahora, en un navegador abrir la url [http://localhost:8080](http://localhost:8080), introducir la URL raíz del aula virtual donde está el moodle del curso que queremos descargar, usuario y contraseña.

## Ejemplo de funcionamiento y uso

[![Mira el vídeo](https://img.youtube.com/vi/Q5XmedD5WZc/hqdefault.jpg)](https://youtu.be/Q5XmedD5WZc)

### Notas importantes

* En el campo de URL se debe introducir la URL a la página raíz del moodle que se desea descargar
* Sólo funcionará para aquellos moodle que tengan habilitados los servicios web para la app del móvil y los servicios REST
    * [Habilitar servicios web móviles en Moodle](https://docs.moodle.org/all/es/Servicios_web_m%C3%B3viles)
    * [Habilitar el protocolo REST en Moodle](https://docs.moodle.org/34/en/Using_web_services#Enabling_protocols)