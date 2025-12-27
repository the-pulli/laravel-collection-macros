<?php

namespace Pulli\LaravelCollectionMacros;

use Illuminate\Support\Collection;
use Pulli\LaravelCollectionMacros\Commands\CreateOrUpdateServiceProviderCommand;
use Pulli\LaravelCollectionMacros\Facades\CollectionMacros;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CollectionMacrosServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pulli-collection-macros')
            ->hasConfigFile()
            ->hasCommand(CreateOrUpdateServiceProviderCommand::class)
            ->publishesServiceProvider('CollectionMacroServiceProvider')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('pulli/laravel-collection-macros');
            });
    }

    #[\Override]
    public function boot(): void
    {
        parent::boot();

        Collection::make(CollectionMacros::all())
            ->reject(fn (string $class, string $macro) => Collection::hasMacro($macro))
            ->each(fn (string $class, string $macro) => Collection::macro($macro, app($class)()));
    }
}
