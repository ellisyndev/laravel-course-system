<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseResource;
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
        $filters = $request->only([
            'sorting', 'direction', 'page', 'limit', 'categories',
            'teacher_id', 'college_id', 'department_id', 'level_code',
            'semester_code', 'classroom_id', 'teacher_name', 'course_code', 'q',
        ]);
        $user = $request->user();

        try {
            $courses = $this->coursetService->getCourseWithPagination($user->id, $filters);

            return $this->apiResponse(CourseResource::collection($courses));
        } catch (\Exception $e) {
            Log::error('CourseController@index', ['message' => $e->getMessage()]);

            return $this->respondError('Failed to retrieve courses'.$e->getMessage());
        }
    }
}
