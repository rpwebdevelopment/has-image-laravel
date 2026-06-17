<?php

namespace RPWebDevelopment\HasImageLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RPWebDevelopment\HasImageLaravel\Commands\HasImageLaravelCommand;

class HasImageLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('has-image-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_has_image_laravel_table')
            ->hasCommand(HasImageLaravelCommand::class);
    }
}
