# Descargar aula virtual Moodle

Aplicación web escrita en PHP que permite conectarse a un aula virtual de Moddle y descargar el curso completo en un archivo comprimido (.zip) o bien descargar de forma selectiva secciones, archivos o carpetas de cada una de las secciones.

## Requisitos

- [Git](https://git-scm.com/). Si descargamos el proyecto utilizando `git clone`
- PHP 7
- [Composer](https://getcomposer.org/)

## Descargar e instalar

1. Descargar el .zip de este proyecto de Github o bien ejecutar: `git clone https://github.com/Dellos7/moodlecontentdownload.git`

2. Dentro de la carpeta del proyecto ejecutar Composer: `composer install`
3. Lanzar servidor local desplegando la carpeta **public**:  `php -S localhost:8080 -t public/`