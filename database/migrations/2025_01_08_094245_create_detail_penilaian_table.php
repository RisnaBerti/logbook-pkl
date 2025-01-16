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
        Schema::create('detail_penilaian', function (Blueprint $table) {
            $table->uuid('id_detail_penilaian')->primary();
            $table->uuid('id_penilaian');
            $table->uuid('id_keterampilan');
            $table->float('nilai', 5, 2);
            $table->timestamps();

            // Tambahkan foreign key
            $table->foreign('id_penilaian')->references('id_penilaian')->on('penilaian')->onDelete('cascade');
            $table->foreign('id_keterampilan')->references('id_keterampilan')->on('keterampilan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_penilaian', function (Blueprint $table) {
            $table->dropForeign(['id_penilaian']);
            $table->dropForeign(['id_keterampilan']);
        });

        Schema::dropIfExists('detail_penilaian');
    }
};
