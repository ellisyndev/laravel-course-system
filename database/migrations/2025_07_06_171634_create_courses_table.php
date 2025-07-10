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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique()->comment('課程代碼');
            $table->string('name');
            $table->text('description')->nullable()->comment('課程簡介');
            $table->text('content')->nullable()->comment('課程大綱');
            $table->foreignId('teacher_id')->constrained('users')->comment('授課教師 ID');
            $table->foreignId('college_id')->nullable()->comment('學院 ID')->constrained('colleges')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->comment('系所 ID')->constrained('departments')->nullOnDelete();
            $table->string('level_code', 1)->comment('課程等級代碼：1~4=大學部、5~8=研究所、A=碩專班、Z=其他');
            $table->foreignId('classroom_id')->nullable()->comment('教室 ID')->constrained('classrooms');
            $table->integer('credit')->default(0)->comment('學分數');
            $table->boolean('is_required')->comment('是否為必修，true=必修，false=選修');
            $table->string('semester_code', 6)->comment('學年度，如 115-1 表示上學期');
            $table->string('start_time_code', 2)->nullable()->comment('上課時間代碼');
            $table->string('end_time_code', 2)->nullable()->comment('下課時間代碼');
            $table->unsignedInteger('max_students')->comment('選課人數上限');
            $table->string('remarks')->nullable()->comment('備註');
            $table->timestamps();

            $table->index(['semester_code', 'code']);
            $table->index('teacher_id');
            $table->index('level_code');

            $table->index(['college_id', 'department_id']);
            $table->index(['teacher_id', 'semester_code']);
            $table->index(['start_time_code', 'end_time_code']);
            $table->index(['semester_code', 'department_id', 'level_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
