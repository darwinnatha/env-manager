<?php

use Darwinnatha\EnvManager\EnvManager;

//create a new file before running the tests
touch(__DIR__.'/../../.env');


it('can add a new environment variable', function () {
    $envManager = new EnvManager();

    // Mocking the .env file location and content
    $envManager->updateOrCreateEnvVariable('KEY', 'new_value', __DIR__.'/../../.env');

    $this->assertFileExists(__DIR__.'/../../.env');
    $envContent = file_get_contents(__DIR__.'/../../.env');
    $this->assertStringContainsString('KEY="new_value"', $envContent);
});

it('can update an existing environment variable', function () {
    $envManager = new EnvManager();
    
    // Assuming the key already exists in the .env file
    $envManager->updateOrCreateEnvVariable('SEC_KEY', 'updated_value', __DIR__.'/../../.env');

    $envContent = file_get_contents(__DIR__.'/../../.env');
    $this->assertStringContainsString('SEC_KEY="updated_value"', $envContent);
    unlink(__DIR__.'/../../.env');
});
