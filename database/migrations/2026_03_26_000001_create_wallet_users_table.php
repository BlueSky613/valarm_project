<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallet_users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('wallet_address', 88)->unique();
            $table->string('cluster', 32)->nullable();
            $table->timestamps();

            $table->unique('username');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_users');
    }
};
