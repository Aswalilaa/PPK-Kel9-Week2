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
        Schema::create('task', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('task_name');
            $table->enum('priority', ['rendah', 'sedang', 'tinggi']);
            $table->dateTime('deadline');
            $table->enum('progress', ['in progress', 'done']);
            $table->char('task_id', 36);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
