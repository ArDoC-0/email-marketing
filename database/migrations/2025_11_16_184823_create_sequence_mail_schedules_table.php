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
        Schema::create('sequence_mail_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sequence_mail_id');
            $table->json('allowed_days');
            $table->string('unit');
            $table->integer('delay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_mail_schedules');
    }
};
