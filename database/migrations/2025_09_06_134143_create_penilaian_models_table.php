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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->ulid('penilaian_id')->primary();
            $table->ulid('indikator_id');
            $table->ulid('indikator_detail_id');
            $table->integer('month');
            $table->integer('year');
            $table->integer('usulan_kegiatan_score');
            $table->integer('realisasi_kegiatan_score');
            $table->text('keterangan');
            $table->text('suppporting_data');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
