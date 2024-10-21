<?php
namespace Modules\Appointments\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appointment_date' => 'required|date',
            'time' => 'required',
            // 'patient_id' => 'required|exists:patients,id',
            // 'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'nullable',
            'doctor_id' => 'nullable',
            'status' => 'required|in:scheduled,completed,cancelled',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponseService::error('Validation errors', 422, $validator->errors())
        );
    }
}
