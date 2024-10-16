<?php
namespace Modules\Surgeries\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAmbulanceRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'driver_name' => 'required|string',
            'ambulance_number' => 'required|string',
            'availability_status' => 'required|in:available,unavailable',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            ApiResponseService::error('Validation errors', 422, $validator->errors()->all())
        );
    }
}
