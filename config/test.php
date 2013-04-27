<?php
/**
 * Created by Asier Marqués.
 * User: Asier
 * Date: 27/04/13
 * Time: 16:53
 */

$app['debug'] = true;

$db_options_file = __DIR__ . "/db_options.test.php";
if(!is_file($db_options_file)){
    throw new \Exception("debes crear el archivo " . $db_options_file . ", simplemente renombra el archivo config/db_options.php.dist" );
}
require $db_options_file;

$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $app["config.db_options"],
));
