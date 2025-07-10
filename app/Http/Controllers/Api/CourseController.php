<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\Api\Course\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected CourseService $coursetService)
    {
        //
    }

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $filters = $request->only(['teacher_id', 'is_required']);

        try {
            $courses = $this->coursetService->getCourseWithPagination($user->id, $filters);

            return $this->apiResponse($courses);
        } catch (\Exception $e) {
            Log::error('CourseController@index', ['message' => $e->getMessage()]);

            return $this->respondError('Failed to retrieve courses:');
        }
    }
}
