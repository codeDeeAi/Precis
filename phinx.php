<?php

use App\Core\Config;

$config = Config::main();

$database_credentials = [
    'adapter' => $config['DATABASE_ADAPTER'] ?? 'mysql',
    'host' => $config['DATABASE_HOST'] ?? 'localhost',
    'name' => $config['DATABASE_NAME'] ?? '',
    'user' => $config['DATABASE_USERNAME'] ?? '',
    'pass' => $config['DATABASE_PASSWORD'] ?? '',
    'port' => $config['DATABASE_PORT'] ?? '3306',
    'charset' => $config['DATABASE_CHARSET'] ?? 'utf8',
];

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/app/database/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/app/database/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => $config['DATABASE_ENVIRONMENT'] ?? 'development',
            'production' => $database_credentials,
            'development' => $database_credentials,
            'testing' => $database_credentials
        ],
        'version_order' => 'creation'
    ];
