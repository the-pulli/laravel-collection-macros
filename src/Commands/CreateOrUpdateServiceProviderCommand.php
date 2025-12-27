<?php

namespace Pulli\LaravelCollectionMacros\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Pulli\LaravelCollectionMacros\Facades\CollectionMacros;

class CreateOrUpdateServiceProviderCommand extends Command
{
    public $signature = 'pulli-collection-macros:create-or-update';

    public $description = 'Creates or updates the corresponding ServiceProvider';

    public function handle(): int
    {
        [$exist, $provider] = $this->returnsIfProviderExistAndPath();

        if ($exist) {
            $this->warn('Overriding Provider...');
            $create = false;
            $update = config('pulli-collection-macros.auto-update');
        } else {
            $this->info('Creating Provider...');
            $create = true;
            $update = false;
        }

        try {
            $result = $this->publishProvider($provider, $create, $update);
        } catch (FileNotFoundException $e) {
            $this->error('Stub files not found: '.$e->getMessage());

            return self::FAILURE;
        }

        if ($result) {
            $this->info(sprintf('Published Provider to: %s', $provider));
        } else {
            $this->error('Failed to create/update Provider');
        }

        return self::SUCCESS;
    }

    private function returnsIfProviderExistAndPath(): array
    {
        $provider = app_path('Providers/CollectionMacroServiceProvider.php');

        return [File::exists($provider), $provider];
    }

    /**
     * @throws FileNotFoundException
     */
    private function publishProvider(string $provider, bool $create = false, bool $update = false): bool
    {
        $providerStub = File::get(__DIR__.'/../../resources/stubs/ServiceProvider.php.stub');
        $macroStub = File::get(__DIR__.'/../../resources/stubs/Macro.stub');

        $result = Collection::make(CollectionMacros::all())
            ->map(fn (string $class, string $macro) => Str::replace(['$MACRO$', '$CLASS$'], [$macro, $class], $macroStub))
            ->pipe(function (Collection $macros) use ($providerStub) {
                $macros = substr_replace($macros->join(PHP_EOL), '', -1);

                return Str::replace('$MACROS$', $macros, $providerStub);
            });

        if ($create || $update) {
            return File::put($provider, $result);
        }

        return false;
    }
}
