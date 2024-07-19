<?php

namespace App\Implementation;

use App\Http\Requests\UserRequest;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getUsers();
    public function getUser();
   
}