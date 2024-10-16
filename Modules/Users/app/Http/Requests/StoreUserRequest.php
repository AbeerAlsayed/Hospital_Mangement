<?php
<<<<<<< HEAD

namespace Modules\Users\Http\Requests;

use App\Services\ApiResponseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
=======
namespace Modules\Users\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
>>>>>>> origin/sarm
    {
        return true;
    }

<<<<<<< HEAD
    public function rules(): array
=======
    public function rules()
>>>>>>> origin/sarm
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
<<<<<<< HEAD
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'role' => 'required|in:doctor,nurse,patient',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException(ApiResponseService::error('Validation errors', 422, $errors));
    }
=======
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'nullable|min:8',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'role' => 'nullable|string|in:patient,doctor,nurse',
        ];
    }
>>>>>>> origin/sarm
}
