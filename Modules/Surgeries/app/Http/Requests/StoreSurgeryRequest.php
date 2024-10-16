<?php
namespace Modules\Surgeries\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSurgeryRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'type_surgery' => 'required|string',
            'date_scheduled' => 'required|date',
            'status_surgery' => 'required|in:scheduled,completed,cancelled',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            ApiResponseService::error('Validation errors', 422, $validator->errors()->all())
        );
    }
}
