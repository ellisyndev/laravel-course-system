<?php

namespace App\Swagger\Api;

/**
 * @OA\Tag(
 *     name="Student",
 *     description="學生相關API"
 * )
 */
class StudentController
{
    /**
     * @OA\Post(
     *     path="/student/courses/select",
     *     tags={"Student"},
     *     summary="選課",
     *     description="選課",
     *     operationId="selectCourse",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         description="Input data format",
     *
     *         @OA\MediaType(mediaType="application/json",
     *
     *             @OA\Schema(
     *                  type="object",
     *                  required={""},
     *
     *                  @OA\Property(property="course_id", type="integer", description="課程ID", example=1),
     *             )
     *        )
     *     ),
     *
     *    @OA\Response(
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
     *                      @OA\Property(property="name", type="string", example="課程名稱", description="課程名稱"),
     *                   @OA\Property(property="description", type="string", example="課程描述", description="課程描述"),
     *               @OA\Property(property="is_required", type="boolean", example=true, description="是否必修"),
     *               @OA\Property(property="teach_id", type="integer", example=1, description="授課教師ID"),
     *            @OA\Property(property="max_students", type="integer", example=30, description="人數上限"),
     *           @OA\Property(property="now_students", type="integer", example=25, description="目前人數"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function selectCourse()
    {
        //
    }


    /**
     * @OA\Post(
     *     path="/student/courses/cancel",
     *     tags={"Course"},
     *     summary="取消選課",
     *     description="取消選課",
     *     operationId="cancelCourse",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         description="Input data format",
     *
     *         @OA\MediaType(mediaType="application/json",
     *
     *             @OA\Schema(
     *                  type="object",
     *                  required={""},
     *
     *                  @OA\Property(property="course_id", type="integer", description="課程ID", example=1),
     *             )
     *        )
     *     ),
     *
     *    @OA\Response(
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
     *                      @OA\Property(property="name", type="string", example="課程名稱", description="課程名稱"),
     *                   @OA\Property(property="description", type="string", example="課程描述", description="課程描述"),
     *               @OA\Property(property="is_required", type="boolean", example=true, description="是否必修"),
     *               @OA\Property(property="teach_id", type="integer", example=1, description="授課教師ID"),
     *            @OA\Property(property="max_students", type="integer", example=30, description="人數上限"),
     *           @OA\Property(property="now_students", type="integer", example=25, description="目前人數"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function cancelCourse()
    {
        //
    }
}
