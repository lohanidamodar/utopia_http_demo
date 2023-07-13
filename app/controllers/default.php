<?php

use Utopia\Http\Http;
use Utopia\Http\Response;

Http::get('/')
    ->inject('response')
    ->action(function(Response $response){
        $response->send('Hello, World!');
    });