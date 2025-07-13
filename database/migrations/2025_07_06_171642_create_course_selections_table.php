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
        Schema::create('course_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->comment('學生 ID');
            $table->foreignId('course_id')->constrained('courses');
            $table->timestamp('enrolled_at')->nullable()->comment('加選時間');
            $table->timestamp('withdrawn_at')->nullable()->comment('退選時間');
            $table->string('status', 10)->comment('狀態');
            $table->timestamps();

            $table->unique(['student_id', 'course_id']);
            $table->index(['student_id', 'course_id']);
            $table->index(['course_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_selections');
    }
};
