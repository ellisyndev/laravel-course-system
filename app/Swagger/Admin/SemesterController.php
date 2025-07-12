<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Semester",
 *     description="學期與時間代碼設定"
 * )
 */
class SemesterController
{
    /**
     * @OA\Get(
     *     path="/semesters",
     *     tags={"Semester"},
     *     summary="查詢學期",
     *     operationId="adminGetSemesters",
     *     security={{"bearerToken":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="code", type="string", example="115-1"),
     *                 @OA\Property(property="name", type="string", example="115學年度 第1學期"),
     *                 @OA\Property(property="start_date", type="string", format="date", example="2025-08-01"),
     *                 @OA\Property(property="end_date", type="string", format="date", example="2026-01-15"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-01T08:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-01T08:00:00Z")
     *             ))
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/semesters",
     *     tags={"Semester"},
     *     summary="新增學期",
     *     operationId="adminCreateSemester",
     *     security={{"bearerToken":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         required={"code", "name", "start_date", "end_date"},
     *         @OA\Property(property="code", type="string", example="115-2"),
     *         @OA\Property(property="name", type="string", example="115學年度 第2學期"),
     *         @OA\Property(property="start_date", type="string", format="date", example="2026-02-10"),
     *         @OA\Property(property="end_date", type="string", format="date", example="2026-07-01")
     *     )),
     *     @OA\Response(response=201, description="成功")
     * )
     */
    public function storeSemester() {}

    /**
     * @OA\Get(
     *     path="/time_codes",
     *     tags={"Semester"},
     *     summary="查詢節次時間代碼",
     *     operationId="adminGetTimeCodes",
     *     security={{"bearerToken":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
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
     *     tags={"Semester"},
     *     summary="新增節次時間代碼",
     *     operationId="adminCreateTimeCode",
     *     security={{"bearerToken":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"code", "time"},
     *             @OA\Property(property="code", type="string", example="2"),
     *             @OA\Property(property="time", type="string", example="0930")
     *         )
     *     ),
     *     @OA\Response(response=201, description="成功")
     * )
     */
    public function storeTimeCode() {}
}
