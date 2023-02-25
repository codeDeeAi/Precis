<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface RouteInit
{
    ## Handle function
    public function handle(): void;
}
