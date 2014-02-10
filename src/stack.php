<?php

$map = [
    '/bot' => require __DIR__ . '/bot.php'
];

$app = (new Stack\Builder())
    ->push('Stack\UrlMap', $map)
    ->resolve($app);

return $app;