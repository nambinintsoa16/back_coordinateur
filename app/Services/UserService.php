<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Implementation\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserService
{

    private UserRepositoryInterface $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(): Collection|array
    {
        return $this->userRepository->getUsers();
    }

    public function getUser(): object|null
    {
        return $this->userRepository->getUser();
    }


}