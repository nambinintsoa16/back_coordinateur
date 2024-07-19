<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
         /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Se connecter",
     *          @OA\RequestBody(
     *          required=true,
     *          description="Informations ",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="matricule", type="string"),
     *              @OA\Property(property="password", type="string"),
     *          ),
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Connectes"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="E-mail ou mot de passe n'existe pas"
     *     ),
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('matricule', 'password');
        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

     /**
     * @OA\Post (
     *     path="/api/auth/logout",
     *     security={{"bearerAuth": {}}},
     *     summary="Se deconnecter",
     *     @OA\Response(
     *         response="200",
     *         description="Vous etes deconnectes"
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Accès interdit pour les non-Connectes"
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

}
