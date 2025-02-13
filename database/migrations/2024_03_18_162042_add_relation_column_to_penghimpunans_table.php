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
        Schema::table('penghimpunans', function (Blueprint $table) {
            $table->foreignId('sumber_dana_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('program_sumber_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tahun_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId( 'user_id')->nullable()->constrained()->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penghimpunans', function (Blueprint $table) {
            $table->dropForeign('sumber_dana_id');
            $table->dropForeign('program_sumber_id');
            $table->dropForeign('tahun_id');
            $table->dropForeign('user_id');
        });
    }
};
