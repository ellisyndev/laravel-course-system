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
     *
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
     *
     *      @OA\Parameter(
     *          name="q", in="query", description="關鍵字搜尋", required=false,
     *
     *          @OA\Schema(type="string", example=""),
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(type="object",
     *
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
     *     tags={"Course"},
     *     summary="新增課程",
     *     description="新增課程",
     *     operationId="createCourse",
     *     security={
     *     {"bearerToken": {}}
     *     },
     *
     *     @OA\RequestBody(
     *     description="課程資料",
     *     required=true,
     *
     *     @OA\MediaType(
     *        mediaType="application/json",
     *
     *     @OA\Schema(
     *        type="object",
     *
     *     @OA\Property(property="name", type="string", description="課程名稱", example="範例課程"),
     *     @OA\Property(property="description", type="string", description="課程描述", example="範例課程敘述"),
     *     @OA\Property(property="content", type="string", description="課程大綱", example="範例課程內容"),
     *     @OA\Property(property="college_id", type="integer", description="學院ID", example=1),
     *     @OA\Property(property="department_id", type="integer", description="系所ID", example=1),
     *     @OA\Property(property="teacher_id", type="integer", description="授課教師ID", example=1),
     *     @OA\Property(property="level_code", type="string", description="年級代碼", example="1"),
     *     @OA\Property(property="classroom_id", type="integer", description="教室ID", example=1),
     *     @OA\Property(property="credit", type="integer", description="學分數", example=3),
     *     @OA\Property(property="is_required", type="boolean", description="是否必修", example=true),
     *     @OA\Property(property="semester_code", type="string", description="學年度代碼", example="115-1"),
     *     @OA\Property(property="weekday", type="string", description="上課星期", example="1"),
     *     @OA\Property(property="start_time_code", type="string", description="上課時間代碼", example="1"),
     *     @OA\Property(property="end_time_code", type="string", description="下課時間代碼", example="2"),
     *     @OA\Property(property="max_students", type="integer", description="人數上限", example=30),
     *     @OA\Property(property="remarks", type="string", description="備註", example="無"),
     *
     *   )
     *    )
     * *     ),
     *
     *     @OA\Response(
     *      response=201,
     *     description="課程創建成功",
     *
     *     @OA\JsonContent(
     *
     *        @OA\Property(property="code", type="integer", description="狀態代碼", example=201),
     *     @OA\Property(property="message", type="string", description="結果描述", example="課程創建成功"),
     *     @OA\Property(
     *     property="data",
     *     type="object",
     *     @OA\Property(property="id", type="integer", description="課程ID", example=1),
     *     @OA\Property(property="name", type="string", description="課程名稱", example="範例課程"),
     *     @OA\Property(property="description", type="string", description="課程描述", example="範例課程敘述"),
     *     @OA\Property(property="is_required", type="boolean", description="是否必修", example=true),
     *     @OA\Property(property="teach_id", type="integer", description="授課教師ID", example=1),
     *     @OA\Property(property="max_students", type="integer", description="人數上限", example=30),
     *     @OA\Property(property="now_students", type="integer", description="目前人數", example=0),
     *     @OA\Property(property="created_at", type="string", format="date-time", description="建立時間", example="2021-07-07 12:00:00"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", description="更新時間", example="2021-07-07 12:00:00")
     *     )
     *    )
     *     ),
     *
     *     @OA\Response(response="401", ref="#/components/responses/401"),
     *     @OA\Response(response="422", ref="#/components/responses/422"),
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
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
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
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *
     *     @OA\RequestBody(required=true, @OA\JsonContent(
     *
     *         @OA\Property(property="name", type="string", example="微積分（一）"),
     *     @OA\Property(property="description", type="string", example="微積分基礎課程"),
     *     @OA\Property(property="content", type="string", example="課程內容包括極限、導數、積分等"),
     *     @OA\Property(property="credit", type="integer", example=4),
     *     @OA\Property(property="is_required", type="boolean", example=true),
     *     @OA\Property(property="teacher_id", type="integer", example=3),
     *     @OA\Property(property="semester_code", type="string", example="115-2"),
     *     @OA\Property(property="classroom_id", type="integer", example=2),
     *     @OA\Property(property="max_students", type="integer", example=40),
     *     @OA\Property(property="remarks", type="string", example="無"),
     *     @OA\Property(property="weekday", type="string", example="2"),
     *     @OA\Property(property="start_time_code", type="string", example="1"),
     *     @OA\Property(property="end_time_code", type="string", example="2"),
     *     @OA\Property(property="is_english_taught", type="boolean", example=false),
     *     @OA\Property(property="level_code", type="string", example="1"),
     *     @OA\Property(property="department_id", type="integer", example=1),
     *     @OA\Property(property="college_id", type="integer", example=1),
     *     )),
     *
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
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
     *
     *     @OA\Response(response=204, description="刪除成功")
     * )
     */
    public function destroy() {}
}
