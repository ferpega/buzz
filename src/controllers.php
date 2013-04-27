<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * HOMEPAGE CONTROLLER
 */
$app->get('/', function () use ($app) {

    $model = new \Lib\Model\PostModel($app["db"]);

    return $app['twig']->render('index.html.twig', array("items"=> $model->findAll(array(),array("created_at"=>"DESC"), 2)));


})->bind('homepage');

/**
 * POSTS
 * =====
 */

/**
 * POST_CREATE
 */
$app->get('/', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {

    $model = new \Lib\Model\PostModel($app["db"]);
    $model->create(array("text"=>$request->get("text")));

    return $app->redirect($request->headers->get('referer'));

})
->method("POST")
->bind('post_create');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
