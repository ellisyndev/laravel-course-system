<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="後台登入"
 * )
 */
class AuthController
{
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *     summary="後台登入",
     *     description="使用管理者帳號登入，取得 Bearer Token",
     *     operationId="adminLogin",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"email","password"},
     *
     *             @OA\Property(property="email", type="string", format="email", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Password!123")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="登入成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJh..."),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(property="expires_in", type="integer", example=3600)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="帳號或密碼錯誤"
     *     ),
     * )
     */
    public function login() {}

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="登出",
     *     description="使用管理者帳號登出",
     *     tags={"Auth"},
     *     operationId="adminlogout",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *
     *         @OA\JsonContent(type="object",
     *
     *             @OA\Property( property="message", type="string", example="OK"),
     *         ),
     *     )
     * )
     */
    public function logout()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/auth/profile",
     *     summary="取得管理者資訊",
     *     description="取得管理者資訊",
     *     tags={"Auth"},
     *     operationId="getAdminUserInfo",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="系統管理員"),
     *             @OA\Property(property="email", type="string", example="admin@example.com")
     *         )
     *     )
     * )
     */
    public function profile() {}
}
