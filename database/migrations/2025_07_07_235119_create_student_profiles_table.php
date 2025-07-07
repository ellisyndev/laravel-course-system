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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->foreignId('college_id')->nullable()->comment('學院 ID')->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->comment('系所 ID')->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('entry_year')->nullable()->comment('入學年度（西元年）');
            $table->unsignedTinyInteger('grade')->nullable()->comment('實際年級：大一=1，碩一=5 等');
            $table->enum('education_level', ['bachelor', 'master', 'phd', 'junior_college', 'technical'])->default('bachelor')->comment('學制');
            $table->enum('program_type', ['day', 'night', 'inservice'])->default('day')->comment('日間、夜間、在職');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
