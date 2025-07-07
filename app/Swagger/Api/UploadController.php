<?php

namespace App\Swagger\Api;

class UploadController
{
    /**
     * @OA\Post(
     *     path="/upload",
     *     tags={"Upload"},
     *     summary="檔案上傳，最高10MB",
     *     description="可新增jpg/jpeg/gif/png格式的檔案",
     *     operationId="uploadFile",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="上傳檔案資訊(預設tmp)",
     *
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *
     *             @OA\Schema(
     *                 required={"file"},
     *
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                     description="要上傳的檔案 (jpg, jpeg, gif, png)"
     *                 ),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="上傳成功",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="code", type="integer", description="狀態代碼", example=200),
     *             @OA\Property(property="message", type="string", description="結果描述", example="檔案上傳成功"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="path", type="string", description="檔案儲存路徑", example="storage/uploads/xxxxxx.jpg"),
     *             ),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="請求資料驗證失敗",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="code", type="integer", description="狀態代碼", example=422),
     *             @OA\Property(property="message", type="string", description="錯誤訊息", example="請求資料驗證失敗"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="file", type="array", @OA\Items(type="string"), example={"檔案必須是圖片", "檔案不能大於 10MB"})
     *             )
     *         )
     *     )
     * )
     */
    public function upload() {}
}
