<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model as BaseModel;

# User Model
class UserModel extends BaseModel
{
    public function __construct()
    {
        # Set default model properties ('TABLE', 'COLUMNS')
        $this->setProperties([
            'TABLE' => 'users',
            'COLUMNS' => ['id', 'name', 'password'],
        ]);
    }
}
