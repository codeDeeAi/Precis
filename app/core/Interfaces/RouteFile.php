<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface RouteFile
{
    ## Register Routes function
    public function routes(): array;
}
