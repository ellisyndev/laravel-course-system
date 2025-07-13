<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Classroom",
 *     description="教室資料管理"
 * )
 */
class ClassroomController
{
    /**
     * @OA\Get(
     *     path="/classrooms",
     *     tags={"Classroom"},
     *     summary="取得教室列表",
     *     description="取得所有教室資料，可支援模糊搜尋與分頁",
     *     operationId="adminGetClassrooms",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="sorting", in="query", @OA\Schema(type="string", example="id")),
     *     @OA\Parameter(name="direction", in="query", @OA\Schema(type="string", enum={"asc", "desc"}, example="desc")),
     *     @OA\Parameter(name="page", in="query", @OA\Schema(type="string", example="1")),
     *     @OA\Parameter(name="limit", in="query", @OA\Schema(type="string", example="15")),
     *     @OA\Parameter(name="q", in="query", @OA\Schema(type="string", example="H403")),
     *
     *     @OA\Response(response=200, description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Classroom")),
     *             @OA\Property(property="meta", type="object", ref="#/components/schemas/Meta"),
     *             @OA\Property(property="links", type="object", ref="#/components/schemas/Links")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/classrooms",
     *     tags={"Classroom"},
     *     summary="新增教室",
     *     operationId="adminCreateClassroom",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         required={"code", "name", "location"},
     *
     *         @OA\Property(property="code", type="string", example="H503"),
     *         @OA\Property(property="name", type="string", example="電資大樓 H503"),
     *         @OA\Property(property="location", type="string", example="電資大樓 5 樓")
     *     )),
     *
     *     @OA\Response(response=200, description="成功",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Classroom")
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/classrooms/{id}",
     *     tags={"Classroom"},
     *     summary="查詢單筆教室",
     *     operationId="adminShowClassroom",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *
     *     @OA\Response(response=200, description="成功",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Classroom")
     *     )
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/classrooms/{id}",
     *     tags={"Classroom"},
     *     summary="更新教室資料",
     *     description="更新指定教室的代碼、名稱與地點",
     *     operationId="adminUpdateClassroom",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"code", "name"},
     *
     *             @OA\Property(property="code", type="string", example="H101"),
     *             @OA\Property(property="name", type="string", example="普通教學館 101 教室 調整"),
     *             @OA\Property(property="location", type="string", example="普通教學館 1 樓 調整")
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
     *             @OA\Property(property="message", type="string", example="更新教室成功"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/Classroom")
     *         )
     *     )
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/classrooms/{id}",
     *     tags={"Classroom"},
     *     summary="刪除教室資料",
     *     description="根據教室 ID 刪除指定教室資料",
     *     operationId="adminDeleteClassroom",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=2)),
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
