<?php

$db_options_file = __DIR__ . "/db_options.php";
if(!is_file($db_options_file)){
    throw new \Exception("debes crear el archivo " . $db_options_file . ", simplemente renombra el archivo config/db_options.php.dist" );
}
require $db_options_file;

$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $app["config.db_options"],
));

$tw_options_file = __DIR__ . "/twitter_options.php";
if(!is_file($db_options_file)){
    throw new \Exception("debes crear el archivo " . $db_options_file . ", simplemente renombra el archivo config/twitter_options.php.dist" );
}
require $tw_options_file;
$app->register(new \Simettric\Silex\TwitterServiceProvider\TwitterServiceProvider(), $app["config.twitter_options"]);
