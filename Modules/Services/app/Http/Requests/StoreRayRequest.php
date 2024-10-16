<?php

namespace Modules\Services\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'radiology_type' => 'required|string|max:255',
            'imaging_date' => 'required|date',
            'results' => 'nullable|string',
            'status' => 'required|in:pending,completed',
        ];
    }
}
