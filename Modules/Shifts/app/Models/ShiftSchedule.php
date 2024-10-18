<?php
namespace Modules\Shifts\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftSchedule extends Model
{
    protected $fillable = [
        'shiftable_type',
        'department_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function shiftable()
    {
        return $this->morphTo();
    }
}
