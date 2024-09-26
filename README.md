# API Framework


This is a simple API framework that can be used to create APIs.


## Installation:
```bash
composer require anshu-krishna/api-framework
```

## Quick Start Guide (using the provided sample code as example):

Let's create a simple API server and on the way learn how to use this framework.

See the [sample](./sample/) directory for the full sample server code.

In this example we will assume that this server is running at  https://api.sample.dev .

### Files List:
```
codebase-root/
├─ api-funcs-base/
│  ├─ @all.php
│  ├─ @index.php
│  ├─ Ping.php
│  ├─ Example/
│  │  ├─ @all.php
│  │  ├─ @index.php
│  │  ├─ Adder.php
│  │  ├─ CamelCase/
│  │  │  ├─ @index.php
│  │  │  ├─ Hello.php
├─ public/
│  ├─ .htaccess
│  ├─ index.php
```

#### Explanation of the listed files:

- `codebase-root/` is the root directory of the codebase. Choose any directory.

- `codebase-root/api-funcs-base/` is the directory where all the API definitions are stored.
    *Directory name does not need to be `api-funcs-base`. It can be anything.*

	- `@all.php` [Optional] is the file that is called for all the functions in this directory ***and its subdirectories***.

	- `@index.php` [Optional] File that defines the api available at https://api.sample.dev

	- `Ping.php` is the file that defines the api available at https://api.sample.dev/ping

	- `Example/` is a directory that contains more API functions.

		- `@all.php` [Optional] is the file that is called for all the functions in this directory ***and its subdirectories***.

		- `@index.php` [Optional] File that defines the api available at https://api.sample.dev/example

		- `Adder.php` is the file that defines the api available at https://api.sample.dev/example.adder

		- `CamelCase/` is a directory that contains more API functions.

			- `@index.php` [Optional] File that defines the api available at https://api.sample.dev/example.camel_case

			- `Hello.php` is the file that defines the api available at https://api.sample.dev/example.camel_case.hello


- `codebase-root/public/` is the public directory where the server is running.
    *Directory name does not need to be `public`. It can be anything.*

	- `.htaccess` is the file that redirects all requests to `index.php`.

	- `index.php` is the file that initializes the API framework.



#### Sample code for some of the files (with explanations/comments):

```php
<?php  // file: codebase-root/public/index.php

require_once '../vendor/autoload.php';

use Krishna\API\Config;
use Krishna\API\Server;

Config::$dev_mode = true; // Set to false in production
Config::$zlib = false;    // Set to true if you want to compress the output

// See Krishna\API\Config for more options


// Initialize the server
Server::init(
	func_base_path: __DIR__ . '/../api-funcs-base',
);

// Start executing api request
Server::execute();

```

```php
<?php  // file: codebase-root/api-funcs-base/Ping.php

// This API expects either no parameters or a single parameter 'msg' of type string;
// See DataValidator in the notes below to see more examples of possible signatures

use Krishna\API\Func;

// Set the signature of the function
Func::set_signature([
	'?msg' => 'string',
]);


// Set the definition of the function
Func::set_definition(function(array $data, string $funcName) {
	if(!array_key_exists('msg', $data)) {
		return 'Hello; No message received';
	}
	return 'Hello; Message received: ' . $data['msg'];
});

```

See the [sample](./sample/) directory for the full sample server code.

___

### Sample Requests and Responses:

#### Request:
`https://api.sample.dev/ping`

#### Response:
```json
{
    "status": 0, // 0 = Success
    "value": "Hello; No message received",

    // Meta information; Only available in dev_mode
    "meta": {
        "exe_time": 0.0130339, // Execution time in seconds
        "mem_peak": 560848     // Peak memory usage in bytes
    },

    // Debug information set using Debugger::dump() function;
    // Only available in dev_mode
    "debug": [ 
        {
            "at": "File: codebase-root/api-funcs-base/@all.php; Line: 7",
            "value": "Hello from @all at the root of the API functions directory"
        }
    ]
}
```

```php
<?php
Config::$dev_mode = false; // This will disable the debug and meta information in the response
```

---

#### Request:

`https://api.sample.dev/ping?msg=ABCD`

or

`https://api.sample.dev/ping` with POST data `{"msg":"ABCD"}`

or

`https://api.sample.dev/ping/msg/ABCD`

#### Response:
```json
{
    "status": 0,
    "value": "Hello; Message received: ABCD"
}
```
---

#### Request:

`https://api.sample.dev/example.adder?add[]=1&add[]=2&add[]=3`

or

`https://api.sample.dev/example.adder` with POST data `{ "add" : [1,2,3] }`

#### Response:
```json
{
    "status": 0,
    "value": 6
}
```
---

#### Request:

`https://api.sample.dev/does_not_exist`

#### Response:
```json
{
    "status": 1, // See src/StatusType.php for all possible status codes
    "status_desc": "Invalid_Request",
    "value": "API 'does_not_exist' not found"
}
```



#### Notes:

- [GitHub DataValidator](https://github.com/anshu-krishna/PHP-Data-Validator)