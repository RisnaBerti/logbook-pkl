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
        Schema::table('riwayat_mentoring', function (Blueprint $table) {
            // Tambahkan kolom sertifikat
            $table->uuid('id_mentor')->nullable()->after('id_riwayat_mentoring');

            $table->foreign('id_mentor')->references('id_mentor')->on('mentor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_mentoring', function (Blueprint $table) {
            // Hapus kolom id_mentor
            $table->dropForeign('id_mentor');
            $table->dropColumn('id_mentor');
        });
    }
};
