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
        Schema::create('indikator', function (Blueprint $table) {
            $table->ulid('indikator_id')->primary();
            $table->text('sasaran');
            $table->text('indikator_kinerja');
            $table->integer('target');
            $table->integer('pagu_anggaran');
            $table->integer('koreksi_normalisasi');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator');
    }
};
