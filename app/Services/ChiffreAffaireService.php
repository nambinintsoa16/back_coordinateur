<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\ChiffreAffaireRepository;
use App\Implementation\ChiffreAffaireRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ChiffreAffaireService
{

    private ChiffreAffaireRepositoryInterface $chiffreAffaireRepository;


    public function __construct(ChiffreAffaireRepository $chiffreAffaireRepository)
    {
        $this->chiffreAffaireRepository = $chiffreAffaireRepository;
    }
    public function getChiffreAffaire()
    {
        return $this->chiffreAffaireRepository->getChiffreAffaire();
    }

    
}