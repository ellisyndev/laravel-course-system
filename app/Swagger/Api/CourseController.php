<?php

namespace App\Swagger\Api;

/**
 * @OA\Tag(
 *     name="Article",
 *     description="文章"
 * )
 */
class CourseController
{
    /**
     * @OA\Get(
     *     path="/courses",
     *     tags={"Course"},
     *     summary="取得課程列表",
     *     description="取得課程列表",
     *     operationId="getCourses",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="sorting", in="query", description="排序欄位(預設id)", required=false,
     *
     *         @OA\Schema(type="string", example="id"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="direction", in="query", description="排序方向(預設desc)", required=false,
     *
     *         @OA\Schema(type="string", example="desc", enum={"asc", "desc"}),
     *     ),
     *
     *     @OA\Parameter(
     *         name="page", in="query", description="頁碼(預設1)", required=false,
     *
     *         @OA\Schema(type="string", example="1"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="limit", in="query", description="筆數(預設15)", required=false,
     *
     *         @OA\Schema(type="string", example="15"),
     *     ),
     *
     *     @OA\Parameter(
     *     name="is_required", in="query", description="是否必修(預設false)", required=false,
     *
     *     @OA\Schema(type="boolean", example=false),
     *     ),
     *
     *     @OA\Parameter(
     *          name="teacher_id", in="query", description="授課教師ID", required=false,
     *
     *     @OA\Schema(type="integer", example=1),
     *     ),
     *
     *          @OA\Parameter(
     *          name="college_id", in="query", description="學院ID", required=false,
     *
     *          @OA\Schema(type="integer", example=1),
     *      ),
     *
     *      @OA\Parameter(
     *          name="department_id", in="query", description="系所ID", required=false,
     *
     *          @OA\Schema(type="integer", example=1),
     *      ),
     *
     *      @OA\Parameter(
     *          name="level_code", in="query", description="年級代碼", required=false,
     *
     *          @OA\Schema(type="string", example="1"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="semester_code", in="query", description="學年度代碼", required=false,
     *
     *          @OA\Schema(type="string", example="115-1"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="classroom_id", in="query", description="教室ID", required=false,
     *
     *          @OA\Schema(type="integer", example=5),
     *      ),
     *
     *      @OA\Parameter(
     *          name="teacher_name", in="query", description="教師姓名模糊搜尋", required=false,
     *
     *          @OA\Schema(type="string", example="林"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="course_code", in="query", description="課程代碼", required=false,
     *
     *          @OA\Schema(type="string", example="CHI1001"),
     *      ),
     *
     *     @OA\Parameter(
     *         name="q", in="query", description="關鍵字搜尋", required=false,
     *
     *         @OA\Schema(type="string", example=""),
     *     ),
     *
     *     @OA\Response(
     *           response=200,
     *           description="Success",
     *
     *           @OA\JsonContent(
     *
     *                @OA\Property( property="code", type="integer", description="狀態代碼", example=200),
     *                @OA\Property( property="message", type="string", description="結果描述", example="操作成功"),
     *                @OA\Property(
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(type="object",
     *
     *                           @OA\Property(property="id", type="integer", example=1, description="id"),
     *                       @OA\Property(property="name", type="string", example="課程名稱", description="課程名稱"),
     *                       @OA\Property(property="description", type="string", example="課程描述", description="課程描述"),
     *                   @OA\Property(property="is_required", type="boolean", example=true, description="是否必修"),
     *                   @OA\Property(property="teach_id", type="integer", example=1, description="授課教師ID"),
     *                    @OA\Property(property="max_students", type="integer", example=30, description="人數上限"),
     *               @OA\Property(property="now_students", type="integer", example=25, description="目前人數"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *                @OA\Property( property="meta", type="object", ref="#/components/schemas/Meta"),
     *                @OA\Property( property="links", type="object", ref="#/components/schemas/Links"),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function index()
    {
        //
    }
}
