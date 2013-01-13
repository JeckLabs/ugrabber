<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

require_once __DIR__.'/config.php';

$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addGlobal('base_url', $app['config.baseUrl']);

    return $twig;
}));

$app->get('/', function () use ($app) {
	return $app['twig']->render('index.html');
});

$app->run();