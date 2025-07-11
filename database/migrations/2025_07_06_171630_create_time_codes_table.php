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
            $table->string('start_time', 4)->comment('hhmm，例如 1300');
            $table->string('end_time', 4)->comment('hhmm，例如 1350');
            $table->enum('period', ['morning', 'noon', 'afternoon', 'evening'])->comment('時段：morning=上午, noon=中午, afternoon=下午, evening=晚上');
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
