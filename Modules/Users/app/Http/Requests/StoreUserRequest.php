<?php
namespace Modules\Users\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'nullable|min:8',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'role' => 'nullable|string|in:patient,doctor,nurse',
        ];
    }
}
