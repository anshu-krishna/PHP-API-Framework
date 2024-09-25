# PHP-API-Framework

This repository contains a lightweight PHP framework designed for building APIs quickly and efficiently.

## Features

- **Lightweight**: The framework is designed to be minimal and efficient, focusing on essential API development features.
- **Easy to use**: Provides a simple and intuitive structure for creating API endpoints[1].
- **Flexible**: Allows developers to customize and extend functionality as needed[1].

## Installation

To use this framework, you can clone the repository or include it in your project using Composer.

```bash
git clone https://github.com/anshu-krishna/PHP-API-Framework.git
```

Or add it to your `composer.json` file:

```json
{
    "require": {
        "anshu-krishna/php-api-framework": "dev-main"
    }
}
```

## Usage

```php
<?php
require 'path/to/framework/autoload.php';

$api = new APIFramework();

$api->get('/users', function($request) {
    // Handle GET request for users
});

$api->post('/users', function($request) {
    // Handle POST request for creating a user
});

$api->run();
```

## Support

For support or questions about using this framework, you can open an issue on the GitHub repository or contact the repository owner, Anshu Krishna.
