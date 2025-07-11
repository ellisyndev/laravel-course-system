<?php

namespace App\Services\Admin\AdminAuth;

use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AdminAuthService
{
    public string $verifiedRedirectTo;

    public function __construct(
        protected AdminRepository $adminRepository
    ) {
    }

    public function authenticate(array $attributes): array
    {
        $user = $this->adminRepository->findWhere(['email' => $attributes['email']])->first();

        if (! $user || ! Hash::check($attributes['password'], $user->password)) {
            abort(400, '資料不正確');
        }
        if (empty($user->email_verified_at)) {
            abort(403, '帳號未驗證');
        }
        $token = $user->createToken('Admin');

        return [
            'token_type' => 'Bearer',
            'token' => $token->plainTextToken,
            'user_id' => $user->id,
            'role' => $user->role,
        ];
    }
}
