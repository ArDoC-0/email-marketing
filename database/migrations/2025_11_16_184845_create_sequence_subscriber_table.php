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
        Schema::create('sequence_subscriber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id');
            $table->foreignId('sequence_id')->constrained('sequences');
            $table->timestamp('subscriberd_at');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_subscriber');
    }
};
