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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no_induk');
            $table->string('nama');
            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'pustakawan', 'admin']);
            $table->enum('status', ['aktif', 'non-aktif'])->nullable();
            $table->boolean('deleted')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
