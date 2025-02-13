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
        Schema::table('penyalurans', function (Blueprint $table) {
            $table->foreignId('ashnaf_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('program_pilar_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('kabupaten_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('tahun_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sumber_dana_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('program_sumber_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyalurans', function (Blueprint $table) {
            $table->dropForeign('ashnaf_id');
            $table->dropForeign('pilar_id');
            $table->dropForeign('kabupaten_id');
            $table->dropForeign('tahun_id');
            $table->dropForeign('sumber_dana_id');
            $table->dropForeign('program_sumber_id');
            $table->dropForeign('user_id');
        });
    }
};
