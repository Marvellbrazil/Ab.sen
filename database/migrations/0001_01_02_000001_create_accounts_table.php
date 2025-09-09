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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('id_account')->primary()->autoIncrement()->unique();
            $table->string('name', 75);
            $table->string('username', 30)->unique();
            $table->string('email', 100)->unique();
            $table->string('raw_password', 100)->nullable();
            $table->string('password', 100);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->text('profile')->unique();
            $table->timestamps();
            $table->dateTime('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
