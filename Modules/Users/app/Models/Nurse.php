<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'shift',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع القسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
