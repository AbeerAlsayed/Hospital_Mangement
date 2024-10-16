<?php

namespace Modules\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Patient;

// use Modules\Services\Database\Factories\LaboratoryFactory;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'patient_id',
        'doctor_id',
        'test_date',
        'results',
        'status',
    ];

    // العلاقات
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    // protected static function newFactory(): LaboratoryFactory
    // {
    //     // return LaboratoryFactory::new();
    // }
}
