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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pakar_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('judul');
            $table->string('thumbnail');
            $table->integer('jmlh_peserta'); // Mengubah tipe data menjadi integer
            $table->string('no_rekening');
            $table->integer('pertemuan');
            $table->integer('harga');
            $table->text('deskripsi'); // Mengubah tipe data menjadi text
            $table->foreign('pakar_id')->references('id')->on('pakars');
            $table->foreign('admin_id')->references('id')->on('admins')->nullable(); // Menggunakan nullable() jika admin_id boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
