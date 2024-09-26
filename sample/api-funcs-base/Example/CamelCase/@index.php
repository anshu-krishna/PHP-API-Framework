<?php

use Krishna\API\Func;

Func::set_definition(function (array $params, string $functionName) {
	return 'Hello from CamelCase';
});