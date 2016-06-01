#!/usr/bin/php
<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Push\Server;

chdir(__DIR__);

require dirname(__DIR__) . '/vendor/autoload.php';
$config = require(dirname(__DIR__) . '/config.php');

if(!$config['enabled']) {
	exit('Server disabled in config.php');
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
  		  new Server()
  		)
  	),
    $config['port']
);

$server->run();
