<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Selection",
 *     description="學生選課查詢／管理"
 * )
 */
class SelectionController
{
    /**
     * @OA\Get(
     *     path="/selections",
     *     tags={"Selection"},
     *     summary="查詢選課紀錄",
     *     operationId="adminGetSelections",
     *     security={ {"bearerToken": {}} },
     *     @OA\Parameter(
     *         name="student_id", in="query", required=false, @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="course_id", in="query", required=false, @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="成功")
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/selections",
     *     tags={"Selection"},
     *     summary="新增選課",
     *     operationId="adminCreateSelection",
     *     security={ {"bearerToken": {}} },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"student_id", "course_id"},
     *             @OA\Property(property="student_id", type="integer", example=5),
     *             @OA\Property(property="course_id", type="integer", example=10)
     *         )
     *     ),
     *     @OA\Response(response=201, description="成功")
     * )
     */
    public function store() {}
}

