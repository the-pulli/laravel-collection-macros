<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Pulli\LaravelCollectionMacros\Commands\CreateOrUpdateServiceProviderCommand;

beforeEach(function () {
    $this->actual = app_path('Providers/CollectionMacroServiceProvider.php');
    $this->expected = __DIR__.'/../resources/stubs/CollectionMacroServiceProvider.php.stub';
    File::delete($this->actual);
});

it('can execute the command to publish the service provider', function () {
    executeCommandAndCheckOutput(CreateOrUpdateServiceProviderCommand::class);
    compareFiles();
});

it('can execute the command via defined aliases to publish the service provider', function (string $alias) {
    executeCommandAndCheckOutput($alias);
    compareFiles();
})->with([
    'pcm:create-or-update',
    'pcm:refresh',
]);

it('can publish the service provider from the package itself', function () {
    $this->artisan('vendor:publish', ['--tag' => 'pulli-collection-macros-provider'])
        ->assertSuccessful();

    compareFiles();
});

function executeCommandAndCheckOutput(string $command): void
{
    $test = test();

    $test->artisan($command)
        ->assertSuccessful()
        ->expectsOutputToContain('Creating Provider...')
        ->expectsOutputToContain(sprintf('Published Provider to: %s', $test->actual))
        ->doesntExpectOutputToContain('Overriding Provider...');
}

function compareFiles(): void
{
    $test = test();

    try {
        $actual = File::get($test->actual);
        $expected = File::get($test->expected);
    } catch (FileNotFoundException $e) {
        $test->fail('File not found: '.$e->getMessage());
    }

    expect($test->actual)->toBeFile()
        ->and($actual)->toBe($expected);
}
