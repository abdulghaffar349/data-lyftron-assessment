<?php

namespace App\Services;

use App\Models\User;

class UserService extends ModalUtils
{
    public function __construct()
    {
        $this->model(User::class);
    }
}
