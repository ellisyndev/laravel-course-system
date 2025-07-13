<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="TimeCode",
 *     description="節次時間管理",
 * )
 */
class TimeCodeController
{
    /**
     * @OA\Get(
     *     path="/time_codes",
     *     tags={"TimeCode"},
     *     summary="查詢節次時間",
     *     operationId="adminGetTimeCodes",
     *     security={{"bearerToken":{}}},
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
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="code", type="string", example="1"),
     *                 @OA\Property(property="time", type="string", example="0830"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             ))
     *         )
     *     )
     * )
     */
    public function getTimeCodes() {}

    /**
     * @OA\Post(
     *     path="/time_codes",
     *     tags={"TimeCode"},
     *     summary="新增節次時間",
     *     operationId="adminCreateTimeCode",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"code", "time"},
     *
     *             @OA\Property(property="code", type="string", example="2"),
     *             @OA\Property(property="time", type="string", example="0930")
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="成功")
     * )
     */
    public function storeTimeCode() {}
}
