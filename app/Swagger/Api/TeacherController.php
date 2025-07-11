<?php

namespace App\Swagger\Api;

/**
 * @OA\Tag(
 *     name="Teacher",
 *     description="教師相關API"
 * )
 */
class TeacherController
{
    /**
     * @OA\Post(
     *     path="/teacher/courses",
     *     tags={"Teacher"},
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
     *     @OA\Property(property="level_code", type="string", description="年級代碼", example="1"),
     *     @OA\Property(property="classroom_id", type="integer", description="教室ID", example=1),
     *     @OA\Property(property="credit", type="integer", description="學分數", example=3),
     *     @OA\Property(property="is_required", type="boolean", description="是否必修", example=true),
     *     @OA\Property(property="semester_code", type="string", description="學年度代碼", example="115-1"),
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
}
