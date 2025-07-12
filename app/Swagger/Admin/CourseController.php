<?php

namespace App\Swagger\Admin;

/**
 * @OA\Tag(
 *     name="Course",
 *     description="課程管理"
 * )
 */
class CourseController
{
    /**
     * @OA\Get(
     *     path="/courses",
     *     summary="取得課程列表",
     *     tags={"Course"},
     *     operationId="adminGetCourses",
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
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(type="object",
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="code", type="string", example="CHI1001"),
     *                 @OA\Property(property="name", type="string", example="現代中文選讀"),
     *                 @OA\Property(property="credit", type="integer", example=3),
     *                 @OA\Property(property="is_required", type="boolean", example=true),
     *                 @OA\Property(property="teacher_id", type="integer", example=5),
     *                 @OA\Property(property="teacher_name", type="string", example="林大明"),
     *                 @OA\Property(property="semester_code", type="string", example="115-1"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-10T10:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-10T10:00:00Z")
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
     *     path="/courses",
     *     summary="新增課程",
     *     tags={"Course"},
     *     operationId="adminCreateCourse",
     *     security={{"bearerToken":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         required={"code","name","teacher_id","credit","semester_code"},
     *         @OA\Property(property="code", type="string", example="MATH1001"),
     *         @OA\Property(property="name", type="string", example="微積分（一）"),
     *         @OA\Property(property="description", type="string", example="介紹極限、微分與積分的基本概念"),
     *         @OA\Property(property="content", type="string", example="課程將涵蓋極限、連續性、一變數微積分等..."),
     *         @OA\Property(property="credit", type="integer", example=3),
     *         @OA\Property(property="teacher_id", type="integer", example=2),
     *         @OA\Property(property="department_id", type="integer", example=3),
     *         @OA\Property(property="classroom_id", type="integer", example=5),
     *         @OA\Property(property="is_required", type="boolean", example=true),
     *         @OA\Property(property="semester_code", type="string", example="115-1"),
     *         @OA\Property(property="max_students", type="integer", example=30),
     *         @OA\Property(property="remarks", type="string", example="本課程建議大一修習")
     *     )),
     *     @OA\Response(response=201, description="建立成功")
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/courses/{id}",
     *     summary="取得單一課程",
     *     tags={"Course"},
     *     operationId="adminShowCourse",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="code", type="string", example="CHI1001"),
     *             @OA\Property(property="name", type="string", example="現代中文選讀"),
     *             @OA\Property(property="description", type="string", example="課程介紹"),
     *             @OA\Property(property="content", type="string", example="詳細課程內容"),
     *             @OA\Property(property="credit", type="integer", example=3),
     *             @OA\Property(property="teacher_id", type="integer", example=2),
     *             @OA\Property(property="teacher_name", type="string", example="王小明"),
     *             @OA\Property(property="semester_code", type="string", example="115-1"),
     *             @OA\Property(property="classroom_id", type="integer", example=5),
     *             @OA\Property(property="is_required", type="boolean", example=true),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     )
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/courses/{id}",
     *     summary="更新課程",
     *     tags={"Course"},
     *     operationId="adminUpdateCourse",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *         @OA\Property(property="name", type="string", example="微積分（一）"),
     *         @OA\Property(property="teacher_id", type="integer", example=3),
     *         @OA\Property(property="credit", type="integer", example=3),
     *         @OA\Property(property="is_required", type="boolean", example=false),
     *         @OA\Property(property="remarks", type="string", example="修課限制：數學系學生優先")
     *     )),
     *     @OA\Response(response=200, description="更新成功")
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/courses/{id}",
     *     summary="刪除課程",
     *     tags={"Course"},
     *     operationId="adminDeleteCourse",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *     @OA\Response(response=204, description="刪除成功")
     * )
     */
    public function destroy() {}
}
