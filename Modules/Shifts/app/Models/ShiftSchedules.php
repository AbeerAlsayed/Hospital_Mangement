<?php

namespace Modules\Shifts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Shifts\Database\Factories\ShiftSchedulesFactory;

class Shift_Schedules extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ShiftSchedulesFactory
    // {
    //     // return ShiftSchedulesFactory::new();
    // }
}
