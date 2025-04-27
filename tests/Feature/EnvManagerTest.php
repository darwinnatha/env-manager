<?php

use Darwinnatha\EnvManager\EnvManager;
use Mockery;

beforeEach(function () {
    // Créer un fichier .env temporaire pour les tests
    $this->tempEnvPath = __DIR__ . '/../../.env.testing';
    file_put_contents($this->tempEnvPath, "EXISTING_KEY=old_value\n");
});

afterEach(function () {
    // Nettoyer après chaque test
    if (file_exists($this->tempEnvPath)) {
        unlink($this->tempEnvPath);
    }
    Mockery::close();
});

it('peut ajouter une nouvelle variable d\'environnement', function () {
    $envManager = new EnvManager();
    
    $envManager->updateOrCreateEnvVariable('NEW_KEY', 'new_value', $this->tempEnvPath);
    
    $envContent = file_get_contents($this->tempEnvPath);
    expect($envContent)->toContain('NEW_KEY="new_value"');
});

it('peut mettre à jour une variable d\'environnement existante', function () {
    $envManager = new EnvManager();
    
    $envManager->updateOrCreateEnvVariable('EXISTING_KEY', 'updated_value', $this->tempEnvPath);
    
    $envContent = file_get_contents($this->tempEnvPath);
    expect($envContent)->toContain('EXISTING_KEY="updated_value"');
    expect($envContent)->not->toContain('EXISTING_KEY=old_value');
});

it('lance une exception si le chemin est un répertoire', function () {
    $envManager = new EnvManager();
    
    expect(fn() => $envManager->updateOrCreateEnvVariable('KEY', 'value', __DIR__))
        ->toThrow(Exception::class, 'The provided path is a directory, not a file.');
});

it('lance une exception si le fichier .env n\'existe pas', function () {
    $envManager = new EnvManager();
    $nonExistentPath = __DIR__ . '/non_existent.env';
    
    expect(fn() => $envManager->updateOrCreateEnvVariable('KEY', 'value', $nonExistentPath))
        ->toThrow(Exception::class, 'The provided file does not exist.');
});


