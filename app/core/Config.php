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
    public static function main(): Array
    {
        return [
            'BASE_VIEW_PATH' => dirname(__DIR__, 1).'/views',
        ];
    }
}