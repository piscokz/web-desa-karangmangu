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
    Schema::create('village_contacts', function (Blueprint $table) {
        $table->id('id_contact'); // primary key custom
        $table->string('no_telepon');
        $table->string('email');
        $table->string('instagram');
        $table->string('youtube');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_contacts');
    }
};
