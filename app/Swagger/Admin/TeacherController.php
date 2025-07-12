<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Teacher",
 *     description="教師資料管理"
 * )
 */
class TeacherController
{
    /**
     * @OA\Get(
     *     path="/teachers",
     *     tags={"Teacher"},
     *     summary="取得教師列表",
     *     description="取得教師資料",
     *     operationId="adminGetTeachers",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(
     *          name="sorting", in="query", description="排序欄位(預設id)", required=false,
     *
     *          @OA\Schema(type="string", example="id"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="direction", in="query", description="排序方向(預設desc)", required=false,
     *
     *          @OA\Schema(type="string", example="desc", enum={"asc", "desc"}),
     *      ),
     *
     *      @OA\Parameter(
     *          name="page", in="query", description="頁碼(預設1)", required=false,
     *
     *          @OA\Schema(type="string", example="1"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="limit", in="query", description="筆數(預設15)", required=false,
     *
     *          @OA\Schema(type="string", example="15"),
     *      ),
     *      @OA\Parameter(
     *          name="q", in="query", description="關鍵字搜尋", required=false,
     *
     *          @OA\Schema(type="string", example=""),
     *      ),
     *     @OA\Response(response=200, description="成功", @OA\JsonContent(
     *         @OA\Property(property="code", type="integer", example=200),
     *         @OA\Property(property="message", type="string", example="操作成功"),
     *         @OA\Property(property="data", type="array", @OA\Items(
     *             @OA\Property(property="id", type="integer", example=11),
     *             @OA\Property(property="name", type="string", example="林小明"),
     *             @OA\Property(property="email", type="string", example="teacher@example.com"),
     *             @OA\Property(property="department_id", type="integer", example=3),
     *             @OA\Property(property="title", type="string", example="副教授"),
     *             @OA\Property(property="office", type="string", example="B202"),
     *             @OA\Property(property="phone_ext", type="string", example="7788"),
     *             @OA\Property(property="expertise", type="string", example="資料探勘、演算法"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time"),
     *         )),
     *         @OA\Property(property="meta", type="object", ref="#/components/schemas/Meta"),
     *         @OA\Property(property="links", type="object", ref="#/components/schemas/Links")
     *     ))
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/teachers",
     *     tags={"Teacher"},
     *     summary="新增教師資料",
     *     operationId="adminCreateTeacher",
     *     security={{"bearerToken":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         required={"name","email","password","department_id"},
     *         @OA\Property(property="name", type="string", example="林小明"),
     *         @OA\Property(property="email", type="string", format="email", example="teacher@example.com"),
     *         @OA\Property(property="password", type="string", example="Password123"),
     *         @OA\Property(property="department_id", type="integer", example=3),
     *         @OA\Property(property="title", type="string", example="教授"),
     *         @OA\Property(property="office", type="string", example="B202"),
     *         @OA\Property(property="phone_ext", type="string", example="7788"),
     *         @OA\Property(property="expertise", type="string", example="演算法設計、AI 應用")
     *     )),
     *     @OA\Response(response=201, description="成功", @OA\JsonContent(
     *         @OA\Property(property="code", type="integer", example=201),
     *         @OA\Property(property="message", type="string", example="建立成功"),
     *         @OA\Property(property="data", type="object",
     *             @OA\Property(property="id", type="integer", example=12),
     *             @OA\Property(property="name", type="string", example="林小明"),
     *             @OA\Property(property="email", type="string", example="teacher@example.com"),
     *             @OA\Property(property="created_at", type="string", format="date-time")
     *         )
     *     ))
     * )
     */
    public function store() {}

    /**
     * @OA\Put(
     *     path="/teachers/{id}",
     *     tags={"Teacher"},
     *     summary="更新教師資料",
     *     operationId="adminUpdateTeacher",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=12)),
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         @OA\Property(property="name", type="string", example="林小明"),
     *         @OA\Property(property="email", type="string", format="email", example="teacher@example.com"),
     *         @OA\Property(property="password", type="string", example="NewPassword!456"),
     *         @OA\Property(property="department_id", type="integer", example=3),
     *         @OA\Property(property="title", type="string", example="講師"),
     *         @OA\Property(property="office", type="string", example="C302"),
     *         @OA\Property(property="phone_ext", type="string", example="1234"),
     *         @OA\Property(property="expertise", type="string", example="多媒體設計、教育科技")
     *     )),
     *     @OA\Response(response=200, description="更新成功", @OA\JsonContent(
     *         @OA\Property(property="code", type="integer", example=200),
     *         @OA\Property(property="message", type="string", example="更新成功")
     *     ))
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/teachers/{id}",
     *     tags={"Teacher"},
     *     summary="刪除教師資料",
     *     operationId="adminDeleteTeacher",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=12)),
     *     @OA\Response(response=200, description="刪除成功", @OA\JsonContent(
     *         @OA\Property(property="code", type="integer", example=200),
     *         @OA\Property(property="message", type="string", example="刪除成功")
     *     ))
     * )
     */
    public function destroy() {}
}
