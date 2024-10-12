<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Departments\Models\Department;
use Modules\Users\Database\Factories\DoctorFactory;

class Doctor extends Model
{
    use HasFactory;

    // الحقول القابلة للتعبئة
    protected $fillable = [
        'user_id',
        'specialization',
        'department_id',
        'salary',
    ];

    // العلاقة مع نموذج المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع نموذج القسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

     protected static function newFactory()
     {
          return DoctorFactory::new();
     }
}
