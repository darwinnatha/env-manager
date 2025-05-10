<?php

use Darwinnatha\EnvManager\Facades\EnvManagerFacade as EnvManager;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    // Crée un faux fichier .env.example
    File::put(base_path('.env.example'), "APP_NAME=\"Laravel\"\nAPP_ENV=\"local\"\n");

    // S'assurer que .env est supprimé avant chaque test
    if (File::exists(base_path('.env'))) {
        File::delete(base_path('.env'));
    }
});

afterEach(function () {
    // Nettoyage
    File::delete(base_path('.env.example'));
    if (File::exists(base_path('.env'))) {
        File::delete(base_path('.env'));
    }
});

it('creates .env from .env.example and sets a key', function () {
    EnvManager::set('NEW_KEY', 'my_value');

    $content = File::get(base_path('.env'));
    expect($content)->toContain('NEW_KEY="my_value"');
});

it('updates an existing key in .env', function () {
    File::put(base_path('.env'), "FOO=\"bar\"\n");

    EnvManager::set('FOO', 'baz');

    $content = File::get(base_path('.env'));
    expect($content)->toContain('FOO="baz"');
    expect($content)->not->toContain('FOO="bar"');
});

it('adds a key if it does not exist in .env', function () {
    File::put(base_path('.env'), "EXISTING=\"yes\"\n");

    EnvManager::set('NEW_KEY', 'hello');

    $content = File::get(base_path('.env'));
    expect($content)->toContain('NEW_KEY="hello"');
    expect($content)->toContain('EXISTING="yes"');
});

it('removes a key from .env', function () {
    File::put(base_path('.env'), "TO_DELETE=\"remove_me\"\nKEEP_ME=\"ok\"\n");

    EnvManager::remove('TO_DELETE');

    $content = File::get(base_path('.env'));
    expect($content)->not->toContain('TO_DELETE');
    expect($content)->toContain('KEEP_ME="ok"');
});

it('does not fail when removing a non-existent key', function () {
    File::put(base_path('.env'), "KEY1=\"value\"\n");

    EnvManager::remove('NON_EXISTENT');

    $content = File::get(base_path('.env'));
    expect($content)->toContain('KEY1="value"');
});
