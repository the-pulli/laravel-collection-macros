<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Pulli\LaravelCollectionMacros\Commands\CreateOrUpdateServiceProviderCommand;

beforeEach(function () {
    $this->actual = app_path('Providers/CollectionMacroServiceProvider.php');
    $this->expected = __DIR__.'/../resources/stubs/CollectionMacroServiceProvider.php.stub';
    File::delete($this->actual);
});

it('can execute the command to publish the service provider', function () {
    $this->artisan(CreateOrUpdateServiceProviderCommand::class)
        ->assertSuccessful()
        ->expectsOutputToContain('Creating Provider...')
        ->expectsOutputToContain(sprintf('Published Provider to: %s', $this->actual))
        ->doesntExpectOutputToContain('Overriding Provider...');

    compareFiles($this->actual, $this->expected);
});

it('can publish the service provider from the package itself', function () {
    $this->artisan('vendor:publish', ['--tag' => 'pulli-collection-macros-provider'])
        ->assertSuccessful();

    compareFiles($this->actual, $this->expected);
});

function compareFiles(string $file1, string $file2): void
{
    try {
        $actual = File::get($file1);
        $expected = File::get($file2);
    } catch (FileNotFoundException $e) {
        test()->fail('File not found: '.$e->getMessage());
    }

    expect($file1)->toBeFile()
        ->and($actual)->toBe($expected);
}
