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
        Schema::create('mentor', function (Blueprint $table) {
            $table->uuid('id_mentor')->primary();
            $table->string('nama_mentor', 50);
            $table->string('email_mentor', 50)->unique();
            $table->string('alamat_mentor', 150);
            $table->string('no_telp_mentor', 15);
            $table->string('foto_mentor')->nullable();
            $table->string('ttd_mentor', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor');
    }
};
