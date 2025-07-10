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
        Schema::create('time_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2)->unique()->comment('時間代碼');
            $table->string('time', 4)->comment('時間格式 HHMM，如 0830 表示 08:30');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_codes');
    }
};
