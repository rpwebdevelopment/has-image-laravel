<?php

declare(strict_types=1);

namespace RPWebDevelopment\HasImageLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HasImageLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('has-image-laravel')
            ->hasConfigFile('image-handling');
    }
}
