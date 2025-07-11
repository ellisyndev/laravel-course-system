<?php

namespace App\Swagger\Api;

class AuthController
{
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="登入",
     *     description="登入,<p>測試帳號：S0000001 / T0000001</p><p>密碼皆為：password1</p>",
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
     *                 @OA\Property( property="password", description="密碼", type="string", example="Password!123")
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
     *                 @OA\Property( property="code", type="integer", description="狀態代碼", example=200),
     *                 @OA\Property( property="message", type="string", description="結果描述", example="操作成功"),
     *             @OA\Property( property="data", type="object",
     *                 @OA\Property( property="token_type", type="string", description="token類型", example="Bearer"),
     *                 @OA\Property( property="token", type="string", description="token", example="3|sDOHhfF2gtzp5zNsXNx9yYmAjNcoOecTB1cr3UWD"),
     *                 @OA\Property( property="user_id", type="integer", description="使用者ID", example=1),
     *                 @OA\Property( property="role", type="string", description="使用者角色", example="student")
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
}
