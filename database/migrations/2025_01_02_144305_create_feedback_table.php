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
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid('id_feedback')->primary();
            $table->uuid('id_anak_pkl');
            $table->uuid('id_mentor');
            $table->uuid('id_jurnal');
            $table->date('tanggal_feedback');
            $table->string('isi_feedback');
            $table->timestamps();

            $table->foreign('id_anak_pkl')->references('id_anak_pkl')->on('anak_pkl')->onDelete('cascade');
            $table->foreign('id_mentor')->references('id_mentor')->on('mentor')->onDelete('cascade');
            $table->foreign('id_jurnal')->references('id_jurnal')->on('jurnal')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            $table->dropForeign(['id_anak_pkl']);
            $table->dropForeign(['id_mentor']);
            $table->dropForeign(['id_jurnal']);
        });
        Schema::dropIfExists('feedback');
    }
};
