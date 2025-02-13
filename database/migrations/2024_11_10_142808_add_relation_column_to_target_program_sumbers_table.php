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
        Schema::table('target_program_sumbers', function (Blueprint $table) {
            $table->foreignId('program_sumber_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tahun_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('target_program_sumbers', function (Blueprint $table) {
            //
        });
    }
};
