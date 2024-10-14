<?php

namespace Modules\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Services\Database\Factories\LaboratoryFactory;

class Laboratory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): LaboratoryFactory
    // {
    //     // return LaboratoryFactory::new();
    // }
}
