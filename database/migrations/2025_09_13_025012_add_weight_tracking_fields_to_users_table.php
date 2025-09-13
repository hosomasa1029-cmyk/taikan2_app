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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('height', 5, 2)->nullable()->comment('身長（cm）');
            $table->decimal('initial_weight', 5, 2)->nullable()->comment('初期体重（kg）');
            $table->decimal('target_weight', 5, 2)->nullable()->comment('目標体重（kg）');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'height',
                'initial_weight',
                'target_weight',
            ]);
        });
    }
};
