<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\Api\OptionService;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(
        protected OptionService $optionService
    ) {}

    public function colleges(): \Illuminate\Http\JsonResponse
    {
        $data = $this->optionService->getColleges();

        return $this->respondSuccess($data, '取得學院資料成功');
    }

    public function departments(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'college_id' => 'required|integer|exists:colleges,id',
        ]);

        $data = $this->optionService->getDepartments($request->input('college_id'));

        return $this->respondSuccess($data, '取得系所資料成功');
    }

    public function collegesWithDepartments(): \Illuminate\Http\JsonResponse
    {
        $data = $this->optionService->collegesWithDepartments();

        return $this->respondSuccess($data, '取得學院與系所資料成功');
    }

    public function teachers(): \Illuminate\Http\JsonResponse
    {
        $data = $this->optionService->getTeachers();

        return $this->respondSuccess($data, '取得教師資料成功');
    }

    public function classrooms(): \Illuminate\Http\JsonResponse
    {
        $data = $this->optionService->getClassrooms();

        return $this->respondSuccess($data, '取得教室資料成功');
    }

    public function semesters(): \Illuminate\Http\JsonResponse
    {
        $data = $this->optionService->getSemesters();

        return $this->respondSuccess($data, '取得學期資料成功');
    }

    public function timeCodes(): \Illuminate\Http\JsonResponse
    {
        $data = $this->optionService->getTimeCodes();

        return $this->respondSuccess($data);
    }
}
