<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChiffreAffaireService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ChiffreAffaireController extends Controller
{

    private ChiffreAffaireService $chiffreAffaireService;

    public function __construct(ChiffreAffaireService $chiffreAffaireService)
    {
        $this->chiffreAffaireService = $chiffreAffaireService;
        $this->middleware('jwt.auth');
    }

     /**
     * @OA\Get(
     *     path="/api/chiffreAffaire",
     *     security={{"bearerAuth": {}}},
     *     summary="Afficher les chiffre affaire",
     *     @OA\Response(
     *         response="200",
     *         description="chiffre affaire trouvés"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="chiffre affaire non trouvés"
     *     ),
     *     @OA\Response(
     *     response=403,
     *     description="Accès interdit pour les non-administrateurs"),
     *
     * )
     */
    public function getChiffreAffaire(): JsonResponse{
        return response()->json(
            [
                "success" => true,
                "message" => "ChiffreAffaire retrieved successfully",
                "data" => $this->chiffreAffaireService->getChiffreAffaire()
            ]
        );

    }
}
