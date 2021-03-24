<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginForm;
use App\Http\Requests\RegisterForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends BaseApiController
{

    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"user"},
     *   summary="login user",
     *   description="",
     *   operationId="authenticate",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="email",
     *                   description="email user",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="password",
     *                   description="password user",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description="Success create element"),
     * )
     * @param LoginForm $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginForm $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->responseValidationErrors(['error' => 'invalid_credentials']);
            }
        } catch (JWTException $e) {
            return $this->responseWithMessage(500);
        }

        return $this->responseWithData(compact('token'));
    }

    /**
     * @OA\Post(
     *   path="/api/register",
     *   tags={"user"},
     *   summary="register user",
     *   description="",
     *   operationId="register",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="name user",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="email",
     *                   description="email user",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="password",
     *                   description="password user",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description="Success create element"),
     * )
     * @param RegisterForm $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterForm $request): \Illuminate\Http\JsonResponse
    {

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->responseWithData(compact('user', 'token'), 201);
    }
}
