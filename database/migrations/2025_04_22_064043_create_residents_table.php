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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan');
            $table->string('pendidikan');
            $table->string('shdk');
            $table->string('gol_darah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_telp')->nullable();
            $table->unsignedBigInteger('id_kk');
            $table->foreign('id_kk')->references('id')->on('family_cards')->onDelete('cascade');
            $table->string('disabilitas');
            $table->string('organisasi')->default('-');// Pemerintah desa, Bpd, Lpm, Pkk, Mui, Linmas, Bumdes, Karang Taruna, Kepala Dusun, Ketua Rt/rw, Lainnya
            $table->string('foto')->nullable();
            $table->boolean('kematian')->default(false);
            // $table->string('nik_ayah')->nullable();
            // $table->string('nik_ibu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
