<?php

namespace App\Enums;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait AdvancedApiResponseTrait
{
    /**
     * API 響應的默認狀態碼
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * 設置狀態碼
     *
     * @return $this
     */
    protected function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * 成功響應
     */
    protected function respondSuccess(mixed $data = null, ?string $message = null): JsonResponse
    {
        return $this->apiResponse([
            'status' => $this->statusCode,
            'data' => $data,
            'message' => $message,
        ]);
    }

    /**
     * 錯誤響應
     *
     * @param  mixed  $errors
     */
    protected function respondError(string $message, $errors = null, int $statusCode = 400): JsonResponse
    {
        return $this->setStatusCode($statusCode)->apiResponse([
            'status' => $this->statusCode,
            'message' => $message,
            'errors' => $errors,
        ]);
    }

    /**
     * 格式化 API 響應
     *
     * @param  mixed  $data
     */
    protected function apiResponse($data): JsonResponse
    {
        $response = [
            'status' => $this->statusCode,
            'message' => $this->statusCode === 200 ? '操作成功' : '操作失敗',
        ];

        if ($data instanceof ResourceCollection) {
            $resourceData = $data->response()->getData(true);

            return response()->json(array_merge($response, $resourceData), $this->statusCode);
        }

        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }

        if (is_array($data)) {
            $response = array_merge($response, $data);
        } else {
            $response['data'] = $data;
        }

        return response()->json($response, $this->statusCode);
    }

    /**
     * 未找到資源響應
     */
    protected function respondNotFound(string $message = 'Not Found'): JsonResponse
    {
        return $this->respondError($message, null, 404);
    }

    /**
     * 未授權響應
     */
    protected function respondUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->respondError($message, null, 401);
    }
}
