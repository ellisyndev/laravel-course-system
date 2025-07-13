<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'content' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'college_id' => [
                'required',
                'exists:colleges,id',
            ],
            'department_id' => [
                'required',
                'exists:departments,id',
            ],
            'teacher_id' => [
                'nullable',
                Rule::exists('users', 'id')->where('role', 'teacher'),
            ],
            'level_code' => [
                'required',
                'string',
                'size:1', // Assuming level_code is a single character
            ],
            'semester_code' => [
                'required',
                'string',
                'size:5', // Assuming semester_code is in the format like '115-1'
            ],
            'weekday' => [
                'required',
                'string',
                'size:1', // Assuming weekday is a single character representing the day
            ],
            'start_time_code' => [
                'required',
                'string',
                'size:1',
            ],
            'end_time_code' => [
                'required',
                'string',
                'size:1',
            ],
            'classroom_id' => [
                'nullable',
                'exists:classrooms,id',
            ],
            'credit' => [
                'required',
                'integer',
                'min:0',
            ],
            'is_required' => [
                'required',
                'boolean',
            ],
            'max_students' => [
                'required',
                'integer',
                'min:1',
            ],
            'remarks' => [
                'nullable',
                'string',
                'max:100',
            ],
        ];
    }
}
