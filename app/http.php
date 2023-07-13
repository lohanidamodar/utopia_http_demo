<?php

require_once __DIR__ . '/init.php';

use Utopia\CLI\Console;
use Utopia\Http\Http;
use Utopia\Http\Adapter\Swoole\Server;

$server = new Server('0.0.0.0', '80');


$http = new Http($server, 'Asia/Kathmandu');

$http->onWorkerStart(function($server, $workerId) {
    Console::info('Worker ' . ++$workerId . ' started');
});
$http->onStart(function($server) {
    Console::info('Server started. We can do the initializations for first time starting the server here');
});

$http->loadFiles(__DIR__ . '/../public/');

$http->start();