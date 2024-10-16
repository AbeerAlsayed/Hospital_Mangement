<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\ApiResponseService;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'specialization' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'required|numeric',
            'patient_ids' => 'nullable|array',
            'patient_ids.*' => 'exists:patients,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException(
            ApiResponseService::error('Validation errors', 422, $errors)
        );
    }
}
