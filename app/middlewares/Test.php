<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Request;
use App\Core\Traits\Utils\CommonHelpers;

class Test extends Middleware
{
    use CommonHelpers;

    public function handle(){
        $this->request->placeholder = $this->request->server();

        // $this->dd('this is from the Test middleware class');
    }
}
