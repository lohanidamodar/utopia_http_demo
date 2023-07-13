<?php

require_once __DIR__ . '/init.php';

use Utopia\CLI\Console;
use Utopia\Http\Http;
use Utopia\Http\Adapter\Swoole\Server;

$server = new Server('0.0.0.0', '80');

$server->onWorkerStart(function($server, $workerId) {
    Console::info('Worker ' . ++$workerId . ' started');
});

$http = new Http($server, 'Asia/Kathmandu');

$http->loadFiles(__DIR__ . '/../public/');

$http->start();