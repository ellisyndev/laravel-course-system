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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique()->comment('學期代碼，如 115-1');
            $table->string('name', 20)->comment('學期名稱，如 114 學年度第 1 學期');
            $table->string('year', 4)->comment('西元年，如 2025');
            $table->date('start_date')->nullable()->comment('學期開始日期');
            $table->date('end_date')->nullable()->comment('學期結束日期');
            $table->dateTime('course_selection_start')->nullable()->comment('選課開始時間');
            $table->dateTime('course_selection_end')->nullable()->comment('選課結束時間');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
