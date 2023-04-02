<?php

declare(strict_types=1);

namespace App\Core;


/**
 * Class Config
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Config
{
    /**
     * Get config items
     * @return Array
     */
    public static function main(): array
    {
        return [
            'BASE_VIEW_PATH' => dirname(__DIR__, 1) . '/views',
            'USE_DATABASE' => true,
            'DATABASE_ADAPTER' => 'mysql',
            'DATABASE_ENVIRONMENT' => 'development',
            'DATABASE_HOST' => 'localhost',
            'DATABASE_NAME' => 'custom_framework',
            'DATABASE_USERNAME' => 'root',
            'DATABASE_PASSWORD' => '',
            'DATABASE_CHARSET' => 'utf8',
        ];
    }
}
