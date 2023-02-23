<?php

declare(strict_types=1);

namespace App\Core\Traits\Utils;

trait CommonHelpers
{
    /**
     * Die and Dump
     * @param Mixed $value
     * @return void
     */
    public function dd(mixed ...$args): void
    {
        var_dump(...$args);
        die();
    }
}
