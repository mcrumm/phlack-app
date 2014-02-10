<?php

use Crummy\Phlack\Bridge\Symfony\HttpKernel\MainframeKernel;
use Crummy\Phlack\Bot;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$bot = new Application();

$bot->match('/', function (Request $request) {

    return (new MainframeKernel())
        ->attach(new Bot\ExpressionBot('/math'))
        ->attach(new Bot\RepeaterBot())
        ->handle($request)
        ;

})
->method('GET|POST');

return $bot;
 