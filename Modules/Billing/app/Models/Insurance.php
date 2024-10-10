<?php

namespace Modules\Billing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Billing\Database\Factories\InsuranceFactory;

class Insurance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): InsuranceFactory
    // {
    //     // return InsuranceFactory::new();
    // }
}
