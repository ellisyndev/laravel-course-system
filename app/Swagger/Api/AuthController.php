<?php

namespace App\Swagger\Api;

class AuthController
{
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="登入",
     *     description="登入",
     *     tags={"Auth"},
     *     operationId="login",
     *
     *     @OA\RequestBody(
     *         description="Input data format",
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *             @OA\Schema(
     *                 type="object",
     *
     *                 @OA\Property( property="code", description="帳號", type="string", example="S0000001"),
     *                 @OA\Property( property="password", description="密碼", type="string", example="password1")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *
     *         @OA\JsonContent(type="object",
     *
     *             @OA\Property( property="data", type="object",
     *                 @OA\Property( property="token_type", type="string", description="token類型", example="Bearer"),
     *                 @OA\Property( property="token", type="string", description="token", example="3|sDOHhfF2gtzp5zNsXNx9yYmAjNcoOecTB1cr3UWD"),
     *                 @OA\Property( property="name", type="string", description="使用者名稱", example="開發者帳號"),
     *                 @OA\Property( property="email", type="string", description="email帳號", example="admin@test.com"),
     *             ),
     *         ),
     *     )
     * )
     */
    public function login()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="登出",
     *     description="登出",
     *     tags={"Auth"},
     *     operationId="logout",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *         @OA\JsonContent(type="object",
     *             @OA\Property( property="message", type="string", example="OK"),
     *         ),
     *     )
     * )
     */
    public function logout()
    {
        //
    }
}
