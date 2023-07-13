<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/controllers/default.php';

use Utopia\CLI\Console;
use Utopia\Http\Http;

Http::setResource('database', function(){
    return 'MariaDB';
});

Http::onStart()
    ->inject('database')
    ->action(function(string $database){
        Console::info('Server started with database: ' . $database);
    });

Http::onStart()
    ->action(function() {
        Console::info('We can execute multiple hooks when server start');
    });

Http::onWorkerStart()
    ->inject('workerId')
    ->action(function($workerId) {
        Console::info('Worker ' . ++$workerId . ' started');
    });