<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\Api\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use AdvancedApiResponseTrait;

    private AuthService $userAuthService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * 登入
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $attributes = $request->only(['code', 'password']);
        $token = $this->authService->authenticate($attributes);

        return $this->respondSuccess($token);
    }

    /**
     *  登出
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $data = [
            'message' => 'OK',
        ];

        return $this->respondSuccess($data);
    }

    /**
     * 忘記密碼
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $email = $request->input('email');

        try {
            $status = $this->userAuthService->sendResetPasswordEmail($email);
        } catch (\Exception $e) {
            Log::error('[SEND RESET PASSWORD]'.$e->getMessage());

            return $this->failed('Send email failed.', 400);
        }

        if ($status === Password::RESET_THROTTLED) {
            return $this->failed('Reset throttled.', 422);
        }

        $data = [
            'message' => 'OK',
        ];

        return $this->response($data);
    }
}
