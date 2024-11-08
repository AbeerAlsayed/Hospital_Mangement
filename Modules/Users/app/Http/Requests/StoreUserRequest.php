<?php

namespace Modules\Users\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()

    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female',
        ];
        // إذا كان الدور هو طبيب، قم بإضافة القواعد الخاصة بالطبيب
        if ($this->input('role') === 'doctor') {
            $rules['specialization'] = 'required|string|max:255';
            $rules['department_id'] = 'required|exists:departments,id';
            $rules['salary'] = 'required|numeric';
        }

        // إذا كان الدور هو مريض، قم بإضافة القواعد الخاصة بالمريض
        if ($this->input('role') === 'patient') {
            $rules['doctor_id'] = 'required|exists:doctors,id';
            $rules['room_id'] = 'required|exists:rooms,id';  // التأكد من أن room_id مطلوب وصحيح
            $rules['national_number'] = 'required|string|max:20|unique:patients,national_number'; // قواعد التحقق

        }

        // إذا كان الدور هو ممرضة، قم بإضافة القواعد الخاصة بالممرضة
        if ($this->input('role') === 'nurse') {
            $rules['department_id'] = 'required|exists:departments,id';  // القسم الذي تنتمي له الممرضة
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException(ApiResponseService::error('Validation errors', 422, $errors));
    }
}
