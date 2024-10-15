<?php

namespace Modules\Records\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\ApiResponseService;

class StorePatientMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'entry_time' => 'required|date_format:Y-m-d H:i:s',
            'exit_time' => 'nullable|date_format:Y-m-d H:i:s|after:entry_time',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponseService::error('Validation errors', 422, $validator->errors()->all())
        );
    }
}
