<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Semester",
 *     description="學期時間設定"
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
     *
     *     @OA\RequestBody(required=true,
     *
     *      @OA\JsonContent(
     *         required={"code", "name", "start_date", "end_date"},
     *
     *         @OA\Property(property="code", type="string", example="115-2"),
     *         @OA\Property(property="name", type="string", example="115學年度 第2學期"),
     *         @OA\Property(property="start_date", type="string", format="date", example="2026-02-10"),
     *         @OA\Property(property="end_date", type="string", format="date", example="2026-07-01"),
     *          @OA\Property(property="year", type="integer", example=2025),
     *          @OA\Property(property="course_selection_start", type="string", format="string", example="2025-08-25 12:00:00"),
     *          @OA\Property(property="course_selection_end", type="string", format="string", example="2025-09-05 12:00:00")
     *     )),
     *
     *     @OA\Response(
     * response=200,
     * description="成功",
     *
     * @OA\JsonContent(
     *
     * @OA\Property(property="code", type="integer", example=200),
     * @OA\Property(property="message", type="string", example="新增學期成功"),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="id", type="integer", example=5),
     * @OA\Property(property="code", type="string", example="115-2"),
     * @OA\Property(property="name", type="string", example="115學年度 第2學期"),
     * @OA\Property(property="start_date", type="string", format="date"),
     * @OA\Property(property="end_date", type="string", format="date"),
     * @OA\Property(property="year", type="string", example="2025"),
     * @OA\Property(property="course_selection_start", type="string", format="date-time"),
     * @OA\Property(property="course_selection_end", type="string", format="date-time")
     * )
     * )
     * )
     * )
     */
    public function storeSemester() {}

    /**
     * @OA\Put(
     *     path="/semesters/{id}",
     *     tags={"Semester"},
     *     summary="更新學期",
     *     operationId="adminUpdateSemester",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"code", "name", "start_date", "end_date"},
     *
     *             @OA\Property(property="code", type="string", example="115-2"),
     *             @OA\Property(property="name", type="string", example="115學年度 第2學期"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2026-02-10"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2026-07-01"),
     *             @OA\Property(property="year", type="integer", example=2025),
     *             @OA\Property(property="course_selection_start", type="string", format="date-time", example="2025-08-25 12:00:00"),
     *             @OA\Property(property="course_selection_end", type="string", format="date-time", example="2025-09-05 12:00:00")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="更新學期成功"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="code", type="string", example="115-2"),
     *                 @OA\Property(property="name", type="string", example="115學年度 第2學期"),
     *                 @OA\Property(property="start_date", type="string", format="date"),
     *                 @OA\Property(property="end_date", type="string", format="date"),
     *                 @OA\Property(property="year", type="integer", example=2025),
     *                 @OA\Property(property="course_selection_start", type="string", format="date-time"),
     *                 @OA\Property(property="course_selection_end", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function updateSemester() {}

    /**
     * @OA\Delete(
     *     path="/semesters/{id}",
     *     tags={"Semester"},
     *     summary="刪除學期",
     *     operationId="adminDeleteSemester",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="刪除學期成功")
     *         )
     *      )
     * )
     */
    public function destroySemester() {}
}
