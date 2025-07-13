<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="User",
 *     description="使用者資料管理（學生與教師）"
 * )
 */
class UserController
{
    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"User"},
     *     summary="使用者列表（學生或教師）",
     *     description="依據角色過濾學生或教師，可支援姓名、Email 搜尋與分頁",
     *     operationId="adminGetUsers",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="role", in="query", description="角色（student 或 teacher）", @OA\Schema(type="string", enum={"student", "teacher"})),
     *     @OA\Parameter(name="name", in="query", description="使用者姓名關鍵字搜尋", @OA\Schema(type="string", example="王")),
     *     @OA\Parameter(name="email", in="query", description="使用者 Email 關鍵字搜尋", @OA\Schema(type="string", example="example@school.edu")),
     *     @OA\Parameter(name="page", in="query", @OA\Schema(type="integer", example=1)),
     *     @OA\Parameter(name="limit", in="query", @OA\Schema(type="integer", example=15)),
     *     @OA\Parameter(name="sorting", in="query", @OA\Schema(type="string", example="id")),
     *     @OA\Parameter(name="direction", in="query", @OA\Schema(type="string", enum={"asc", "desc"}, example="desc")),
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功回傳使用者列表",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *
     *                 @OA\Items(ref="#/components/schemas/User")
     *             ),
     *
     *             @OA\Property(property="meta", type="object", ref="#/components/schemas/Meta"),
     *             @OA\Property(property="links", type="object", ref="#/components/schemas/Links")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"User"},
     *     summary="取得單一使用者詳細資料",
     *     description="依照使用者角色顯示學生或教師詳細資料",
     *     operationId="adminGetUserDetail",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="id", in="path", required=true, description="使用者 ID", @OA\Schema(type="integer", example=1)),
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功回傳單一使用者資料",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/User")
     *         )
     *     )
     * )
     */
    public function show() {}
}
