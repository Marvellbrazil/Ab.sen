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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id('id_presensi')->primary()->autoIncrement()->unique();
            $table->unsignedBigInteger('id_account');
            $table->unsignedBigInteger('id_kelas');
            $table->text('link_foto')->nullable()->default(null)->unique();
            $table->text('link_video')->nullable()->default(null)->unique();
            $table->text('deskripsi')->nullable()->default(null);
            $table->enum('status', ['belum_hadir', 'hadir', 'izin', 'sakit', 'alpha'])->default('belum_hadir');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('id_account')->references('id_account')->on('accounts');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
