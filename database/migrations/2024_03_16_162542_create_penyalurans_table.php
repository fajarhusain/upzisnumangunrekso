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
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->datetime('tanggal');
            $table->text('uraian');
            $table->integer('nominal');
            $table->integer('lembaga_count')->nullable();
            $table->integer('male_count')->nullable();
            $table->integer('female_count')->nullable();
            $table->string('lampiran')->nullable();
            $table->boolean('pindahdana')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyalurans');
    }
};
