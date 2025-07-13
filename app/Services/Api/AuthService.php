<?php

namespace App\Services\Api;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public string $verifiedRedirectTo;

    public function __construct(
        protected UserRepository $userRepository
    ) {
        $this->verifiedRedirectTo = env('FRONTEND_VERIFIED_EMAIL_PATH', 'http://localhost');
    }

    public function authenticate(array $attributes): array
    {
        $user = $this->userRepository->findWhere(['code' => $attributes['code']])->first();

        if (! $user || ! Hash::check($attributes['password'], $user->password)) {
            abort(400, '資料不正確');
        }
        if (empty($user->email_verified_at)) {
            abort(403, '帳號未驗證');
        }
        $token = $user->createToken('Api');

        return [
            'token_type' => 'Bearer',
            'token' => $token->plainTextToken,
            'user_id' => $user->id,
            'role' => $user->role,
        ];
    }
}
