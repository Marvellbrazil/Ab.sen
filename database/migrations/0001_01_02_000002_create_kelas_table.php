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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas')->primary()->autoIncrement()->unique();
            $table->unsignedBigInteger('id_account');
            $table->string('nama_kelas', 50);
            $table->string('kode_kelas', 6)->unique();
            $table->timestamps();
            $table->foreign('id_account')->references('id_account')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
