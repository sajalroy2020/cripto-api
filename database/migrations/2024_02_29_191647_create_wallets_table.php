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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->double('usdt_deposit',19,4)->default(0);
            $table->double('usdt_bonus',19,4)->default(0);
            $table->double('usdt_roi',19,4)->default(0);
            $table->double('usdt_affiliate',19,4)->default(0);
            $table->double('usdt_withdrawal',19,4)->default(0);
            $table->string('bep20_address')->nullable();
            $table->string('bep20_secret')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
