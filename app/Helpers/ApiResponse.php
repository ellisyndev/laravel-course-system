<?php

namespace App\Helpers;

use App\Enums\ApiCode;
use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = ApiCode::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param  array  $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * @param  null  $code
     * @return mixed
     */
    public function status($status, array $data, $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->statusCode,
        ];

        $data = array_merge($status, $data);

        return $this->respond($data);

    }

    /**
     * @param  int  $code
     * @param  string  $status
     * @return mixed
     */
    public function failed($message, $code = ApiCode::BAD_REQUEST)
    {
        return $this->status('error', [
            'message' => $message,
            'code' => $code,
        ]);
    }

    /**
     * @param  string  $status
     * @return mixed
     */
    public function message($message, $status = 'success')
    {
        return $this->status($status, [
            'message' => $message,
        ]);
    }

    /**
     * @param  string  $status
     * @return mixed
     */
    public function success($data, $status = '操作成功')
    {
        return $this->status($status, compact('data'));
    }

    /**
     * @param  string  $status
     * @return mixed
     */
    public function successPaginate($data, $status = '操作成功')
    {
        return $this->status($status, [
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'from' => $data->firstItem(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'to' => $data->lastItem(),
                'total' => $data->total(),
                'count' => $data->count(),
            ],
            'links' => [
                'fist' => $data->url(1),
                'prev' => $data->previousPageUrl(),
                'self' => $data->url($data->currentPage()),
                'next' => $data->nextPageUrl(),
                'last' => $data->url($data->lastPage()),
            ],
        ]);
    }

    public function customCombinedPaginate($topData, $listData, $status = '操作成功')
    {
        $responseData = [
            'code' => 200,
            'message' => $status,
            'data' => [
                'top' => $topData,
                'list' => $listData,
                'meta' => [
                    'current_page' => $listData->currentPage(),
                    'from' => $listData->firstItem(),
                    'last_page' => $listData->lastPage(),
                    'per_page' => $listData->perPage(),
                    'to' => $listData->lastItem(),
                    'total' => $listData->total(),
                    'count' => $listData->count(),
                ],
                'links' => [
                    'fist' => $listData->url(1),
                    'prev' => $listData->previousPageUrl(),
                    'self' => $listData->url($listData->currentPage()),
                    'next' => $listData->nextPageUrl(),
                    'last' => $listData->url($listData->lastPage()),
                ],
            ],
        ];

        return response()->json($responseData);
    }

    public function response($data = null, $message = null, array $headers = [])
    {
        $status = [
            'code' => $this->getStatusCode(),
            'message' => $message ?? '操作成功',
        ];

        $data = array_merge($status, $data);

        if ($data) {
            return Response::json($data);
        } else {
            return Response::json($status);
        }
    }

    /**
     * @param  string  $message
     * @return mixed
     */
    public function notFound($message = null)
    {
        return $this->setStatusCode(ApiCode::NOT_FOUND)
            ->failed($message ?? 'Not Found', ApiCode::NOT_FOUND);
    }
}
