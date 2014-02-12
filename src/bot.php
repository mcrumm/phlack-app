<?php

use Crummy\Phlack\Bridge\Silex\Application;
use Crummy\Phlack\Bridge\Symfony\HttpKernel\MainframeKernel;
use Crummy\Phlack\Bot;
use Silex\Provider\MonologServiceProvider;
use Symfony\Component\HttpFoundation\Request;

$bot = new Application();

$bot->register(new MonologServiceProvider(), [
    'monolog.name'    => 'bot',
    'monolog.logfile' => __DIR__.'/../logs/bot.log',
]);

$bot->match('/', function (Request $request) use ($bot) {

    $method     = $request->getMethod();
    $parameters = 'POST' === $method ? $request->request : $request->query;

    $bot->log(sprintf('BOT: %s', $method), $parameters->all());

    return (new MainframeKernel())
        ->attach(new Bot\ExpressionBot('/math'))
        ->attach(new Bot\RepeaterBot())
        ->handle($request)
        ;

})
->method('GET|POST');

return $bot;
