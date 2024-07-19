<?php

namespace App\Implementation;

use App\Http\Requests\UserRequest;
use App\Models\Facture;

interface ChiffreAffaireRepositoryInterface
{
    public function getChiffreAffaire();
    
   
}