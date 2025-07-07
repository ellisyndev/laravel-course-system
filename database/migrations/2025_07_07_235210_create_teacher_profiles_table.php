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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->foreignId('college_id')->nullable()->comment('學院 ID')->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->comment('系所 ID')->constrained()->nullOnDelete();

            $table->string('title')->nullable()->comment('職稱，如教授、副教授、講師');
            $table->string('office')->nullable()->comment('辦公室位置，如 H408');
            $table->string('phone_ext')->nullable()->comment('分機號碼');
            $table->text('expertise')->nullable()->comment('研究專長');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
