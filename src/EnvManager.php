<?php

namespace Darwinnatha\EnvManager;

class EnvManager
{
    /**
     * Set a value in the .env file
     *
     * @param string $key
     * @param string $value
     * @param string|null $envPath
     * @throws \Exception
     */
    public function set(string $key, string $value, ?string $envPath = null): void
    {
        $envPath = $this->resolveEnvPath($envPath);

        $envContent = file_get_contents($envPath);
        $keyPattern = "/^{$key}=.*/m";
        $value = '"' . trim($value) . '"';

        if (preg_match($keyPattern, $envContent)) {
            $newEnvContent = preg_replace($keyPattern, "{$key}={$value}", $envContent);
        } else {
            $newEnvContent = rtrim($envContent) . "\n{$key}={$value}\n";
        }

        if (file_put_contents($envPath, $newEnvContent) === false) {
            throw new \Exception('Failed to write to .env file');
        }
    }

    /**
     * Remove a key from the .env file
     *
     * @param string $key
     * @param string|null $envPath
     * @throws \Exception
     */
    public static function remove(string $key, ?string $envPath = null): void
    {
        $envPath = (new self())->resolveEnvPath($envPath, false);

        if (!file_exists($envPath)) {
            return;
        }

        $envContent = file_get_contents($envPath);
        $keyPattern = "/^{$key}=.*(\r?\n)?/";
        $newEnvContent = preg_replace($keyPattern, '', $envContent);

        if (file_put_contents($envPath, trim($newEnvContent) . "\n") === false) {
            throw new \Exception('Failed to write to .env file');
        }
    }

    /**
     * Resolve and prepare the .env file path
     *
     * @param string|null $envPath
     * @param bool $createIfMissing
     * @return string
     * @throws \Exception
     */
    protected function resolveEnvPath(?string $envPath, bool $createIfMissing = true): string
    {
        $envPath = $envPath ?? base_path('.env');

        if (is_dir($envPath)) {
            throw new \Exception('The provided path is a directory, not a file.');
        }

        if (!file_exists($envPath)) {
            if (!$createIfMissing) return $envPath;

            $examplePath = str_replace('.env', '.env.example', $envPath);
            if (!file_exists($examplePath)) {
                throw new \Exception('Neither .env nor .env.example files exist.');
            }

            if (!copy($examplePath, $envPath)) {
                throw new \Exception('Failed to create .env file from .env.example');
            }
        }

        return $envPath;
    }

    /**
     * @deprecated use set() instead
     */
    public function updateOrCreateEnvVariable(string $key, string $value, ?string $envPath): void
    {
        $this->set($key, $value, $envPath);
    }
}
