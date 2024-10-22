<?php

namespace Modules\Shifts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreShiftScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shiftable_type' => 'required|string|in:Modules\\Users\\Models\\Doctor,Modules\\Users\\Models\\Nurse',
            'shiftable_id' => 'required|integer',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'shiftable_type.in' => 'Shift can only be assigned to a Doctor or Nurse.',
            'end_time.after' => 'End time must be after start time.',
        ];
    }
}
