<?php

use Krishna\API\Func;

Func::set_signature([
	'add' => ['number'],
]);

Func::set_definition(function(array $params, string $funcName) {
	$sum = 0;
	foreach($params['add'] as $num) {
		$sum += $num;
	}
	return $sum;
});