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
            $table->string('code')->unique()->comment('課程代碼');
            $table->string('name');
            $table->text('description')->nullable()->comment('課程簡介');
            $table->text('content')->nullable()->comment('課程大綱');
            $table->foreignId('teacher_id')->constrained('users')->comment('授課教師 ID');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms');
            $table->unsignedTinyInteger('credit')->comment('學分數');
            $table->boolean('is_required')->comment('是否為必修，true=必修，false=選修');
            $table->string('year')->comment('學年度，如 115-1 表示上學期');
            $table->unsignedInteger('max_students')->comment('選課人數上限');
            $table->timestamps();
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
