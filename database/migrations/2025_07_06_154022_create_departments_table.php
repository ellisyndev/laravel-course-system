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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique()->comment('系所代碼，如 CS 代表資訊工程系');
            $table->foreignId('college_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('name')->comment('系所名稱，如 資訊工程系');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
