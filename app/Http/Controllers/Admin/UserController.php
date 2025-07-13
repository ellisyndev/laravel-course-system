<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected UserService $userService) {}

    public function index(Request $request)
    {
        $filter = $request->only([
            'sorting', 'direction', 'page', 'limit', 'q', 'role',
        ]);
        $user = $request->user();

        try {
            $users = $this->userService->getUsersWithPagination($filter);

            return $this->apiResponse(UserResource::collection($users));
        } catch (\Exception $e) {
            return $this->respondError('取得使用者列表失敗: '.$e->getMessage());
        }
    }

    public function show(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);

            return $this->respondSuccess(new UserResource($user), '取得使用者資料成功');
        } catch (\Exception $e) {
            return $this->respondError('取得使用者資料失敗: '.$e->getMessage());
        }
    }
}
