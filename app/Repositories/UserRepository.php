<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Implementation\UserRepositoryInterface;
use App\Traits\Validation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    use Validation;

    public function getUsers(): Collection|array
    {
        return User::query()
            ->get();
    }
    public function getUser(): object|null
    {
        $email = Auth::getUser()->email;
        return User::query()
            ->where('email', '=', $email)->first();
    }

}
