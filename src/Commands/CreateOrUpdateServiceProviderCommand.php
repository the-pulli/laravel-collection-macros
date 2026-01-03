<?php

namespace Pulli\LaravelCollectionMacros\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

use function sprintf;

class CreateOrUpdateServiceProviderCommand extends Command
{
    public $signature = 'pulli-collection-macros:create-or-update';

    protected $aliases = [
        'pcm:create-or-update',
        'pcm:refresh',
    ];

    public $description = 'Creates or updates the corresponding ServiceProvider';

    public function handle(): int
    {
        try {
            $stub = File::get(__DIR__.'/../../resources/stubs/CollectionMacroServiceProvider.php.stub');
        } catch (FileNotFoundException) {
            $this->error('Could not find collection macro provider stub.');

            return self::FAILURE;
        }

        $providerPath = app_path('Providers/CollectionMacroServiceProvider.php');
        $providerExists = File::exists($providerPath);

        if (config('pulli-collection-macros.auto-update') && $providerExists) {
            $this->warn('Overriding Provider...');
            File::replace($providerPath, $stub);
        } elseif (! $providerExists) {
            $this->info('Creating Provider...');
            File::put($providerPath, $stub);
        }

        $this->line(sprintf('Published Provider to: %s', $providerPath));

        return self::SUCCESS;
    }
}
