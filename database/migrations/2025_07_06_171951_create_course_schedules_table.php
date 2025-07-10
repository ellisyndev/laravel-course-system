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
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->string('weekday')->comment('Mon, Tue, Wed, Thu, Fri, Sat, Sun');
            $table->foreignId('start_period_id')->constrained('periods');
            $table->foreignId('end_period_id')->constrained('periods');
            $table->timestamps();

            $table->index('weekday', 'idx_schedules_weekday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_schedules');
    }
};
