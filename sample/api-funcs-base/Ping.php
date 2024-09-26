<?php

use Krishna\API\Func;

Func::set_signature([
	'?msg' => 'string',
]);

Func::set_definition(function(array $data, string $funcName) {
	if(!array_key_exists('msg', $data)) {
		return 'Hello; No message received';
	}
	return 'Hello; Message received: ' . $data['msg'];
});