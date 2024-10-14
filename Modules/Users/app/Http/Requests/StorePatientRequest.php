<?php

namespace Modules\Users\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'room_id' => 'required|exists:rooms,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ApiResponseService::error('Validation failed', 422, $validator->errors()));
    }
}
