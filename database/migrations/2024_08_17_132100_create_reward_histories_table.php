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
        Schema::create('reward_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reward_id');
            $table->unsignedBigInteger('referral_id');
            $table->timestamps();

            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
            $table->foreign('referral_id')->references('id')->on('referrals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_histories');
    }
};
