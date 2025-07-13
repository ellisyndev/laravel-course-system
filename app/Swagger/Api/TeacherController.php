<?php

namespace App\Swagger\Api;

/**
 * @OA\Tag(
 *     name="Teacher",
 *     description="教師相關 API"
 * )
 */
class TeacherController
{
    /**
     * @OA\Get(
     *     path="/teacher/courses",
     *     tags={"Teacher"},
     *     summary="查詢教師自己開的課程",
     *     operationId="teacherGetOwnCourses",
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
     *                 @OA\Property(property="name", type="string", example="資料庫系統"),
     *                 @OA\Property(property="semester", type="string", example="115-1"),
     *                 @OA\Property(property="credit", type="integer", example=3),
     *                 @OA\Property(property="is_required", type="boolean", example=true)
     *             ))
     *         )
     *     )
     * )
     */
    public function getOwnCourses() {}

    /**
     * @OA\Put(
     *     path="/teacher/courses/{id}",
     *     tags={"Teacher"},
     *     summary="修改課程內容",
     *     operationId="teacherUpdateCourse",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="name", type="string", example="進階資料庫"),
     *             @OA\Property(property="description", type="string", example="包含索引與效能最佳化"),
     *             @OA\Property(property="content", type="string", example="課程內容包括資料庫設計、SQL查詢、索引與效能最佳化等"),
     *             @OA\Property(property="remarks", type="string", example="請注意課程內容更新"),
     *             @OA\Property(property="is_english_taught", type="boolean", example=false),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="修改成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="修改成功")
     *         )
     *     )
     * )
     */
    public function updateCourse() {}

    /**
     * @OA\Get(
     *     path="/teacher/courses/{id}/students",
     *     tags={"Teacher"},
     *     summary="查詢課程學生名單",
     *     operationId="teacherGetCourseStudents",
     *     security={{"bearerToken":{}}},
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
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
     *                 @OA\Property(property="student_id", type="integer", example=202312345),
     *                 @OA\Property(property="name", type="string", example="張小明"),
     *                 @OA\Property(property="email", type="string", example="student@example.com")
     *             ))
     *         )
     *     )
     * )
     */
    public function getCourseStudents() {}
}
