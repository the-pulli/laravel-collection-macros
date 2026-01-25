<?php

namespace Pulli\LaravelCollectionMacros\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

use function sprintf;

/**
 * Artisan command to create or update the CollectionMacroServiceProvider
 *
 * This command publishes the service provider stub to the application's
 * Providers directory, allowing users to customize macro registration.
 */
class CreateOrUpdateServiceProviderCommand extends Command
{
    public $signature = 'pulli-collection-macros:create-or-update';

    /** @var array<int, string> */
    protected $aliases = [
        'pcm:create-or-update',
        'pcm:refresh',
    ];

    public $description = 'Creates or updates the corresponding ServiceProvider';

    /**
     * Execute the console command
     *
     * @return int Command exit code (SUCCESS or FAILURE)
     */
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
