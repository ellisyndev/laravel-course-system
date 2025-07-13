<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Department",
 *     description="系所資料管理"
 * )
 */
class DepartmentController
{
    /**
     * @OA\Get(
     *     path="/departments",
     *     tags={"Department"},
     *     summary="取得系所列表",
     *     description="取得所有系所資料",
     *     operationId="adminGetDepartments",
     *     security={ {"bearerToken": {}} },

     *
     *     @OA\Parameter(name="sorting", in="query", description="排序欄位(預設id)", required=false, @OA\Schema(type="string", example="id")),
     *     @OA\Parameter(name="direction", in="query", description="排序方向(預設desc)", required=false, @OA\Schema(type="string", example="desc", enum={"asc", "desc"})),
     *     @OA\Parameter(name="page", in="query", description="頁碼(預設1)", required=false, @OA\Schema(type="string", example="1")),
     *     @OA\Parameter(name="limit", in="query", description="筆數(預設15)", required=false, @OA\Schema(type="string", example="15")),
     *     @OA\Parameter(name="q", in="query", description="關鍵字搜尋", required=false, @OA\Schema(type="string", example="電機")),

     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=3),
     *                 @OA\Property(property="name", type="string", example="電機工程學系"),
     *                 @OA\Property(property="college_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )),
     *             @OA\Property(property="meta", type="object", ref="#/components/schemas/Meta"),
     *             @OA\Property(property="links", type="object", ref="#/components/schemas/Links")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/departments",
     *     tags={"Department"},
     *     summary="新增系所資料",
     *     operationId="adminCreateDepartment",
     *     security={ {"bearerToken": {}} },

     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name", "college_id"},
     *
     *        @OA\Property(property="code", type="string", example="EE"),
     *             @OA\Property(property="name", type="string", example="電機工程學系"),
     *             @OA\Property(property="college_id", type="integer", example=1)
     *         )
     *     ),

     *
     *     @OA\Response(
     *         response=200,
     *         description="建立成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="建立成功"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=4),
     *                 @OA\Property(property="name", type="string", example="電機工程學系"),
     *                 @OA\Property(property="college_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/departments/{id}",
     *     tags={"Department"},
     *     summary="取得單一系所資料",
     *     operationId="adminGetDepartment",
     *     security={ {"bearerToken": {}} },

     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=3)),

     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=3),
     *                 @OA\Property(property="name", type="string", example="電機工程學系"),
     *                 @OA\Property(property="college_id", type="integer", example=1),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/departments/{id}",
     *     tags={"Department"},
     *     summary="更新系所資料",
     *     operationId="adminUpdateDepartment",
     *     security={ {"bearerToken": {}} },

     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=3)),

     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="name", type="string", example="資訊工程學系"),
     *             @OA\Property(property="college_id", type="integer", example=1)
     *         )
     *     ),

     *
     *     @OA\Response(
     *         response=200,
     *         description="更新成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="更新成功")
     *         )
     *     )
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/departments/{id}",
     *     tags={"Department"},
     *     summary="刪除系所資料",
     *     operationId="adminDeleteDepartment",
     *     security={ {"bearerToken": {}} },

     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=3)),

     *
     *     @OA\Response(
     *         response=200,
     *         description="刪除成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="刪除成功")
     *         )
     *     )
     * )
     */
    public function destroy() {}
}
