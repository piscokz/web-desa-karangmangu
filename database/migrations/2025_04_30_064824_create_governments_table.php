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
    Schema::create('goverments', function (Blueprint $table) {
        $table->id(); // primary key auto increment
        $table->integer('no');
        $table->string('nama');
        $table->string('jabatan');
        $table->string('jenis_kelamin');
        $table->integer('umur');
        $table->text('alamat');
        $table->string('foto')->nullable();
        $table->enum('kategori', ['Pemerintah desa', 'BPD', 'LPM', 'PKK', 'Lainnya']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governments');
    }
};
