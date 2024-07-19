<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('jwt.auth');
      
    }
       /**
     * @OA\Get(
     *     path="/api/user",
     *     security={{"bearerAuth": {}}},
     *     summary="Afficher les utilisateurs",
     *     @OA\Response(
     *         response="200",
     *         description="Utilisateurs trouvés"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Utilisateurs non trouvés"
     *     ),
     *     @OA\Response(
     *     response=403,
     *     description="Accès interdit pour les non-administrateurs"),
     *
     * )
     */
    public function getUser(){  
        return response()->json(
            [
                "success" => true,
                "message" => "Users retrieved successfully",
                "data" => $this->userService->getUser()
            ]
        );

    }
}
