<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * HOMEPAGE CONTROLLERS
 */
$app->get('/', function () use ($app) {

    $model = new \Lib\Model\PostModel($app["db"]);

    return $app['twig']->render('index.html.twig', array("items"=> $model->findAll(array(),array("created_at"=>"DESC"), 20)));


})->bind('homepage');

/**
 * POST_CREATE
 */
$app->get('/', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {

    $model = new \Lib\Model\PostModel($app["db"]);

    $user = null;
    if($app["security"]->getToken()){
        $user = $app["security"]->getToken()->getUser();
    }

    $user_id = $user instanceof \Simettric\Silex\TwitterServiceProvider\Lib\User\User ? $user->twitter_id : null;

    $model->create(array("text"=>$request->get("text"), "user_id"=>$user_id));

    return $app->redirect($request->headers->get('referer'));

})->method("POST")
  ->bind('post_create');



$app->get('/list.{format}', function ($format, \Symfony\Component\HttpFoundation\Request $request) use ($app) {

    $model = new \Lib\Model\PostModel($app["db"]);

    $items = $model->findAll( array(), array("created_at"=>"DESC"), $request->get("limit"), $request->get("offset", 0));
    switch($format){
        case 'rss':
            return $app['twig']->render('posts/'.$format.'.xml.twig', array("items"=> $items));
        break;

        case "json":
            return $app->json($items);
        break;

        case "html":
            return $app['twig']->render('posts/list.html.twig', array("items"=> $items));
        break;

        default:
            return $app->abort(406, "Noooooooooooooooooooooo, formato no aceptado!");


    }
})
->method("GET")
->bind('list_posts');


$app["twitter"]->setControllers();



$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
