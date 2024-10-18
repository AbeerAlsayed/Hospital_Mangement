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
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'nullable|min:8',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',];

        // إذا كان الدور هو طبيب، قم بإضافة القواعد الخاصة بالطبيب
        if ($this->input('role') === 'doctor') {
            $rules['specialization'] = 'required|string|max:255';
            $rules['department_id'] = 'required|exists:departments,id';
            $rules['salary'] = 'required|numeric';
        }
        if ($this->input('role') === 'patient') {
            $rules['doctor_id'] = 'required|exists:doctors,id';
            $rules['room_id'] = 'required|exists:rooms,id';  // التأكد من أن room_id مطلوب وصحيح
        }

        return $rules;
    }
}
