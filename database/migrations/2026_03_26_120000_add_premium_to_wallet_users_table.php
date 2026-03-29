<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wallet_users', function (Blueprint $table) {
            $table->boolean('premium')->default(false)->after('cluster');
        });
    }

    public function down(): void
    {
        Schema::table('wallet_users', function (Blueprint $table) {
            $table->dropColumn('premium');
        });
    }
};
