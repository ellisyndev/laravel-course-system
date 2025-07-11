<?php

namespace App\Swagger\Api;

/**
 * @OA\Tag(
 *     name="Option",
 *     description="下拉選單相關 API"
 * )
 */
class OptionController
{
    /**
     * @OA\Get(
     *     path="/options/colleges_departments",
     *     tags={"Option"},
     *     summary="取得學院與系所列表",
     *     description="取得每個學院底下的系所",
     *     operationId="getCollegesWithDepartments",
     *       security={
     *           {"bearerToken": {}}
     *       },
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="code", type="string", example="LIT"),
     *                     @OA\Property(property="name", type="string", example="文學院"),
     *                     @OA\Property(property="departments", type="array",
     *
     *                         @OA\Items(
     *
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="college_id", type="integer", example=1),
     *                              @OA\Property(property="code", type="string", example="LIT"),
     *                             @OA\Property(property="name", type="string", example="中文系")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function collegesWithDepartments() {}

    /**
     * @OA\Get(
     *     path="/options/colleges",
     *     tags={"Option"},
     *     summary="取得學院選項",
     *     description="取得所有學院",
     *     operationId="getColleges",
     *      security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="code", type="string", example="LIT"),
     *                     @OA\Property(property="name", type="string", example="文學院")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function colleges() {}

    /**
     * @OA\Get(
     *     path="/options/departments",
     *     tags={"Option"},
     *     summary="依學院取得系所選項",
     *     description="依學院取得系所選項",
     *     operationId="getDepartments",
     *      security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\Parameter(
     *         name="college_id",
     *         in="query",
     *         required=false,
     *         description="學院 ID",
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
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=3),
     *                 @OA\Property(property="code", type="string", example="CHI"),
     *                     @OA\Property(property="name", type="string", example="中文系")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function departments() {}

    /**
     * @OA\Get(
     *     path="/options/teachers",
     *     tags={"Option"},
     *     summary="取得教師選項",
     *     description="取得所有教師",
     *     operationId="getTeachers",
     *      security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=11),
     *                     @OA\Property(property="name", type="string", example="吳玉梅")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function teachers() {}

    /**
     * @OA\Get(
     *     path="/options/classrooms",
     *     tags={"Option"},
     *     summary="取得教室選項",
     *     description="取得所有教室",
     *     operationId="getClassrooms",
     *      security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=5),
     *                     @OA\Property(property="name", type="string", example="H403")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function classrooms() {}

    /**
     * @OA\Get(
     *     path="/options/semesters",
     *     tags={"Option"},
     *     summary="取得學期選項",
     *     description="近年學年度（如 115-1、115-2）",
     *     operationId="getSemesters",
     *      security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="code", type="string", example="115-1")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function semesters() {}

    /**
     * @OA\Get(
     *     path="/options/time_codes",
     *     tags={"Option"},
     *     summary="取得節次選項",
     *     description="取得所有課程節次（時間代碼）",
     *     operationId="getTimeCodes",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="操作成功"),
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="code", type="string", example="01", description="節次代碼"),
     *                     @OA\Property(property="time", type="string", example="0830", description="實際時間 HHMM")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function timeCodes() {}
}
