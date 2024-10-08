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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('registration_id');
            $table->unsignedBigInteger('participant_id');
            $table->enum('type', [
                'kehadiran', 'konsumsi'
            ]);
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('registration');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('participant_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
