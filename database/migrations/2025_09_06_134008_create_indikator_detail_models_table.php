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
        Schema::create('indikator_detail', function (Blueprint $table) {
            $table->ulid('indikator_detail_id')->primary();
            $table->ulid('indikator_id');
            $table->text('kegiatan_name');
            $table->text('keterangan');
            $table->integer('realisasi_anggaran');
            $table->ulid('bidang_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_detail');
    }
};
