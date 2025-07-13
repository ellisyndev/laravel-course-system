<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminAuthService;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    use AdvancedApiResponseTrait;

    private AuthService $userAuthService;

    public function __construct(protected AdminAuthService $authService) {}

    /**
     * 登入
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $attributes = $request->only(['email', 'password']);
        $token = $this->authService->authenticate($attributes);

        return $this->respondSuccess($token);
    }

    /**
     * 登出
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->respondSuccess([], '登出成功');
    }

    public function profile(Request $request)
    {
        $admin = $request->user();

        return $this->respondSuccess($admin, '取得管理員資料成功');
    }
}
