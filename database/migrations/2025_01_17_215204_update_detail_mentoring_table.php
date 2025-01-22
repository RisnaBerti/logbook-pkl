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
        //hapus kolom id_mentor
        Schema::table('detail_mentoring', function (Blueprint $table) {
            //hapus relasi id_mentor
            $table->dropForeign('detail_mentoring_id_mentor_foreign');
            //hapus kolom id_mentor
            $table->dropColumn('id_mentor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //kembalikan kolom id_mentor
        Schema::table('detail_mentoring', function (Blueprint $table) {
            $table->uuid('id_mentor')->after('id_detail_mentoring');
            $table->foreign('id_mentor')->references('id_mentor')->on('mentor');
        });
    }
};
