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
        Schema::create('pakars', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->char('regencies_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->string('no_telepon');
            $table->string('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('instansi');
            $table->string('foto')->nullable();
            $table->string('cv');
            $table->string('portofolio');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('regencies_id')->references('id')->on('regencies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakars');
    }
};
