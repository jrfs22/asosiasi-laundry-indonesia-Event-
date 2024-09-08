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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('registration_id');
            $table->string('name');
            $table->text('laundry_name')->nullable();
            $table->string('phone_number');
            $table->string('certificate_name');
            $table->enum('type', [
                'member',
                'non member'
            ]);

            $table->text('qrcode')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('registration_id')->references('id')->on('registration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
