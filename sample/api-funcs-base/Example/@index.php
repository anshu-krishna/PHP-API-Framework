<?php

use Krishna\API\Func;

Func::set_definition(function(array $params, string $funcName) {
	return 'Hello, from Example';
});