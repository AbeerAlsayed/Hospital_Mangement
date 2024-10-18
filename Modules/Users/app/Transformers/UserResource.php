<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'role' => $this->role,

            // معلومات الطبيب إذا كان المستخدم طبيبًا
            'doctor' => $this->when($this->role === 'doctor' && $this->relationLoaded('doctor'), [
                'specialization' => $this->doctor->specialization ?? null,
                'department' => $this->doctor->department->name ?? null,
                'salary' => $this->doctor->salary ?? null,
                'patients' => $this->doctor->patients ? $this->doctor->patients->pluck('name') : [],
                // التحقق من وجود الشفتات قبل محاولة الوصول إليها
                'shifts' => $this->doctor && $this->doctor->shifts ? $this->doctor->shifts->map(function($shift) {
                    return [
                        'date' => $shift->date,
                        'start_time' => $shift->start_time,
                        'end_time' => $shift->end_time,
                    ];
                }) : [],
            ]),

            // معلومات المريض إذا كان المستخدم مريضًا
            'patient' => $this->when($this->role === 'patient' && $this->relationLoaded('patient'), [
                'doctors' => $this->patient && $this->patient->doctors ? $this->patient->doctors->pluck('name') : [],
                'room' => $this->patient && $this->patient->room ? $this->patient->room->name : null,
            ]),

            // معلومات الممرضة إذا كان المستخدم ممرضة
            'nurse' => $this->when($this->role === 'nurse' && $this->relationLoaded('nurse'), [
                'department' => $this->nurse->department->name ?? null,
                // التحقق من وجود الشفتات قبل محاولة الوصول إليها
                'shifts' => $this->nurse && $this->nurse->shifts ? $this->nurse->shifts->map(function($shift) {
                    return [
                        'date' => $shift->date,
                        'start_time' => $shift->start_time,
                        'end_time' => $shift->end_time,
                    ];
                }) : [],
            ]),

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
