# Env Manager

A Laravel package to easily manage .env file entries. This package provides a simple way to read, write, update, and remove environment variables in your Laravel application's .env file.

## Installation

```bash
composer require darwinnatha/env-manager
```

## Usage

You can use the package either through the Facade or by instantiating the EnvManager class directly.

### Using the Facade
```php
use Darwinnatha\EnvManager\Facades\EnvManagerFacade as EnvManager;

// Set or update a variable
EnvManager::set('APP_NAME', 'My Application');

// Remove a variable
EnvManager::remove('UNUSED_VARIABLE');
```

### Using the Class Directly

```php
use Darwinnatha\EnvManager\EnvManager;

$envManager = new EnvManager();

// Set or update a variable
$envManager->set('APP_NAME', 'My Application');

// Remove a variable (static method)
EnvManager::remove('UNUSED_VARIABLE');
```

### Features
- Automatically creates .env file from .env.example if it doesn't exist
- Updates existing variables without affecting other entries
- Adds new variables if they don't exist
- Safely removes variables while preserving file structure
- Supports custom .env file paths
- Maintains proper .env file formatting

### Custom .env Path
You can specify a custom path for your .env file:

```php
EnvManager::set('APP_NAME', 'My App', '/custom/path/.env');
EnvManager::remove('APP_NAME', '/custom/path/.env');
```

## Error Handling

The package throws exceptions in the following cases:

- When the specified path is a directory
- When neither .env nor .env.example files exist
- When file operations fail
## License

MIT

```
This updated README provides:
1. Clear installation instructions
2. Comprehensive usage examples with both Facade and direct class usage
3. Description of key features
4. Documentation for custom path usage
5. Error handling information
6. Proper code examples that match the actual implementation
```