<?php

use Crummy\Phlack\Bridge\Silex\Application;
use Silex\Provider\MonologServiceProvider;

$app = new Application();

$app->register(new MonologServiceProvider(), array(
    'monolog.name'    => 'web',
    'monolog.logfile' => __DIR__.'/../logs/web.log',
));

return $app;