<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shift_schedules', function (Blueprint $table) {
            $table->id();
            $table->morphs('shiftable'); // يقوم بإنشاء الأعمدة shiftable_id و shiftable_type
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift__schedules');
    }
};
