<?php

namespace App\Repository\User;

use App\Models\User as UserModel;

class User
{
    public function getUser()
    {
        return UserModel::query();
    }
}
