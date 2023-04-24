<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

# User Model
class UserModel extends EloquentModel
{
    protected $table = "users";

    protected $fillable = ['username', 'password', 'email', 'first_name', 'last_name', 'created', 'updated'];
    
    protected $hidden = ['password'];
    
}
