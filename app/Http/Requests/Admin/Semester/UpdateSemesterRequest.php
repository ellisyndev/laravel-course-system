<?php

namespace App\Http\Requests\Admin\Semester;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSemesterRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:5',
                'unique:semesters,code,'.$this->route('semester'),
                'regex:/^\d{3}-[1-2]$/', // 格式如 115-1 或 115-2
            ],
            'name' => [
                'required',
                'string',
                'max:20',
            ],
            'year' => [
                'required',
                'string',
                'size:4', // 西元年格式，如 2025
            ],
            'start_date' => [
                'required',
                'date',
                'date_format:Y-m-d', // 格式如 2025-08-31
            ],
            'end_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:start_date', // 結束日期必須在開始日期之後
            ],
            'course_selection_start' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s', // 格式如 2025-08-25 00:00:00
            ],
            'course_selection_end' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
                'after_or_equal:course_selection_start', // 選課結束時間必須在選課開始時間之後
            ],
        ];
    }
}
