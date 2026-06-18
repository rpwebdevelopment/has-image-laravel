# A package for simplifying image handling on Laravel eloquent models

![Packagist Version](https://img.shields.io/packagist/v/rpwebdevelopment/has-image-laravel)
![Packagist Downloads](https://img.shields.io/packagist/dt/rpwebdevelopment/has-image-laravel)
[![License: MIT](https://img.shields.io/badge/license-MIT-blueviolet.svg)](https://github.com/rpwebdevelopment/has-image-laravel/blob/main/LICENSE.md)

The `has-image-laravel` package is designed to be a lightweight package to simplify image handling on Laravel
models, currently rather than having to handle uploaded files in your controllers, usually leading to significant 
code duplication.

This package allows for image upload handling (including SVG sanitization) on models to be quickly and easily
configured.

## Installation

You can install the package via composer:

```bash
composer require rpwebdevelopment/has-image-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="has-image-laravel-config"
```

The config file dictates the default storage disk to be used, while this can be overridden at a model
level you may find it useful to configure to your default disk:

```php
return [
    'default' => 'local',
];
```

## Usage

```php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RPWebDevelopment\HasImageLaravel\Dto\ImageDetails;
use RPWebDevelopment\HasImageLaravel\Traits\HasImage;

class Foo extends Model
{
    use HasImage;
    
    protected $fillable = [
        ...
        'logo',
        ...
    ];

    public function getImageDetails(): ImageDetails
    {
        /**
        * $storageDisk parameter is optional, if excluded the 
        * default disk from your configuration will be accepted.
        *
        * $maintainFilename parameter is optional (false by default)
        * if true, the uploaded file will maintain the original filename
        * as uploaded. If false a hashed filename will be used.
        */
        return ImageDetails::create(
            imageDirectory: 'DIR_NAME',
            imageFields: ['logo'],
            storageDisk: 'public',
            maintainFilename: true
        );
    }
}

```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Richard Porter](https://github.com/rpwebdevelopment)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
