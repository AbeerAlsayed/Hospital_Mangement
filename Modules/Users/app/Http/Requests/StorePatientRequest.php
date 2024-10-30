<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\ApiResponseService;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'doctor_ids' => 'nullable|array',
            'doctor_ids.*' => 'exists:doctors,id',
            'national_number' => 'required|string|max:20|unique:patients,national_number', // قواعد التحقق

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
