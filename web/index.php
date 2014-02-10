<?php

ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

/** @var \Stack\StackedHttpKernel $app */
$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';
require __DIR__.'/../src/stack.php';
Stack\run($app);