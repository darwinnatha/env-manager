# Env Manager

Manage easily other ways env entries

## Installation

```bash
composer require darwinnatha/env-manager
```

## Usage

```php
<?php

use Darwinnatha\EnvManager\EnvManager;

$envManager = new EnvManager();

$envManager->updateOrCreateEnvVariable('APP_NAME', 'My App');
```

## License

MIT