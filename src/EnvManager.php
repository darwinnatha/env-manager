<?php

namespace Darwinnatha\EnvManager;

class EnvManager
{
    public function updateOrCreateEnvVariable(string $key, string $value, ?string $envPath)
    {
        if (is_null($envPath)) {
            $envPath = base_path('.env');
        }else{
            // verify if the path is a file and not a directory
            if (is_dir($envPath)) {
                throw new \Exception('The provided path is a directory, not a file.');
            }
            //verify if the file exists
            if (!file_exists($envPath)) {
                throw new \Exception('The provided file does not exist.');
            }
        }

        if (!file_exists($envPath)) {
            throw new \Exception('.env file does not exist.');
        }

        // Read the .env file
        $envContent = file_get_contents($envPath);

        // Ver
        $keyExists = preg_match("/^{$key}=.*/m", $envContent);

        // Préparer la nouvelle ligne à écrire
        $value = '"' . trim($value) . '"'; // Vous pouvez adapter cette ligne selon le format attendu des valeurs

        if ($keyExists) {
            $newEnvContent = preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$value}",
                $envContent
            );
        } else { 
            $newEnvContent = $envContent. "\n{$key}={$value}";
            // $newEnvContent =  "{$key}={$value}". PHP_EOL . $envContent;
        }

        file_put_contents($envPath, $newEnvContent);
    }
}
