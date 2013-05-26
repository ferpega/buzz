

## BUZZ

Buzz es un proyecto demo de una aplicación web basada Silex.

La aplicación es un muro de comentarios tipo Twitter, con autenticación de ese servicio.


## Pasos para la instalación

1. Crear la base de datos buzz y sus dos tablas desde los archivos sql que residen en la carpeta sql
2. Instalar [Composer](http://getcomposer.com/) y ejecutar php composer.phar install
3. Crear el archivo config/db_options.php a partir del archivo db_options.php.dist
4. Crear una aplicación Twitter (con la opción de permitir autenticación con twitter activada) y crear el archivo config/twitter_options.php a partir del archivo twitter_options.php.dist
5. Dar permisos de escritura a la carpeta /cache y /logs
6. Apuntar el directorio público del servidor web a /web


7.-


## Licencia

Este proyecto está licenciado bajo los términos de una licencia MIT, consulte el archivo LICENSE para más información.

Asier Marqués 2013

[Simettric](http://simettric.com/ "Simettric, desarrollo de proyectos web para Internet")

This is a new line.
