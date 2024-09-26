<?php

use Krishna\API\Func;
use Krishna\DataValidator\Returner;
use Krishna\Utilities\Debugger;

Debugger::dump('Hello from @all at the root of the API functions directory');

class AllowEveryOne implements \Krishna\API\AuthenticatorInterface {
	// This class should be in a separate file and should be autoloaded
	// This is just a sample authenticator hence it is in the same file
	// You can implement your own authenticator class
	// The class should implement Krishna\API\AuthenticatorInterface


	public function authenticate(array $param, string $functionName) : Returner {
		// This is a sample authenticator that allows access to everyone
		// You can implement your own logic here
		// To deny access, return Returner::invalid('Custom message here');
		return Returner::valid();
	}
}

Func::add_authenticator(new AllowEveryOne());