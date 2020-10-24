<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Access extends Authenticatable
{
    protected $table = "access";
    protected $guard = 'access';
}
