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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->integer('tickets');
            $table->double('amount');
            $table->integer('discount_percentage');
            $table->double('discount_total');
            $table->string('source');
            $table->enum('member', [
                'ya', 'tidak'
            ])->nullable();
            $table->enum('payment_status', [
                'belum bayar',
                'lunas'
            ])->default('belum bayar');
            $table->text('bukti_pembayaran')->default('bukti.jpg');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
