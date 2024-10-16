<?php

namespace Modules\Services\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreLaboratoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'test_name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'test_date' => 'required|date',
            'results' => 'nullable|string',
            'status' => 'required|in:pending,completed',
        ];
    }
}
