<?php
namespace ExampleApp;
require_once '../../vendor/autoload.php';

use Krishna\API\Config;
use Krishna\API\Server;

Config::$dev_mode = true;
Config::$zlib = false;

Server::init(
	func_base_path: __DIR__ . '/../api-funcs-base',
);
Server::execute();