<?php

namespace App\Swagger\Common;

class Swagger
{
    /**
     * @OA\Schema(
     *     schema="Image",
     *     type="object",
     *     description="圖片",
     *
     *     @OA\Property(property="id", type="integer", example=1, description="ID"),
     *     @OA\Property(property="title", type="string", example="title", description="標題"),
     *     @OA\Property(property="alt", type="string", example="alt", description="替代文字"),
     *     @OA\Property(property="caption", type="string", example="caption", description="說明"),
     *     @OA\Property(property="url", type="string", example="https://via.placeholder.com/800x600", description="圖片網址")
     * )
     */
    public function imageSchema()
    {
        //
    }

    /**
     * @OA\Schema(
     *     schema="Meta",
     *     type="object",
     *     description="分頁資訊",
     *
     *     @OA\Property(property="from", type="integer", example=1, description="起始筆數"),
     *     @OA\Property(property="last_page", type="integer", example=1, description="最後頁數"),
     *     @OA\Property(property="per_page", type="integer", example=15, description="每一頁筆數"),
     *     @OA\Property(property="to", type="integer", example=15, description="結束筆數"),
     *     @OA\Property(property="total", type="integer", example=15, description="總筆數"),
     *     @OA\Property(property="count", type="integer", example=15, description="筆數")
     *
     * )
     */
    public function metaSchema()
    {
        //
    }

    /**
     * @OA\Schema(
     *     schema="Links",
     *     type="object",
     *     description="連結",
     *
     *     @OA\Property(property="first", type="string", example="http:://xxxx.xxxx.xxxx", description="第一頁連結"),
     *     @OA\Property(property="prev", type="string", example="http:://xxxx.xxxx.xxxx", description="前一頁連結"),
     *     @OA\Property(property="self", type="string", example="http:://xxxx.xxxx.xxxx", description="目前頁面連結"),
     *     @OA\Property(property="next", type="string", example="http:://xxxx.xxxx.xxxx", description="下一頁連結"),
     *     @OA\Property(property="last", type="string", example="http:://xxxx.xxxx.xxxx", description="最後一頁連結")
     * )
     */
    public function linkSchema()
    {
        //
    }

    /**
     * @OA\Schema(
     *     schema="Tag",
     *     type="object",
     *     description="標籤",
     *
     *     @OA\Property(property="id", type="integer", example=1, description="ID"),
     *     @OA\Property(property="name", type="string", example="name", description="名稱"),
     * )
     */
    public function tagSchema()
    {
        //
    }

    /**
     * @OA\Components(
     *
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="boolean", example=false, description="狀態"),
     *             @OA\Property(property="message", type="string", example="Validation Error", description="訊息"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="boolean", example=false, description="狀態"),
     *             @OA\Property(property="message", type="string", example="Validation Error", description="訊息"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="404",
     *         description="Not Found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="boolean", example=false, description="狀態"),
     *             @OA\Property(property="message", type="string", example="Validation Error", description="訊息"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="422",
     *         description="Validation Error",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="boolean", example=false, description="狀態"),
     *             @OA\Property(property="message", type="string", example="Validation Error", description="訊息"),
     *             @OA\Property(property="errors", type="object", description="錯誤訊息",
     *                 @OA\Property(property="message", type="array", description="錯誤訊息",
     *
     *                     @OA\Items(type="string", example="The message field is required.")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="500",
     *         description="Internal Server Error",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="status", type="boolean", example=false, description="狀態"),
     *             @OA\Property(property="message", type="string", example="Internal Server Error", description="訊息")
     *         )
     *     )
     * )
     */
    public function errorResponse()
    {
        //
    }

    /**
     * @OA\Schema(
     *     schema="Classroom",
     *     type="object",
     *     title="Classroom",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="code", type="string", example="H403"),
     *     @OA\Property(property="name", type="string", example="電資大樓 H403"),
     *     @OA\Property(property="location", type="string", example="電資大樓 4 樓"),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-01T10:00:00Z"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-10T12:30:00Z")
     * )
     */
    public function classroomSchema()
    {
        //
    }
}
