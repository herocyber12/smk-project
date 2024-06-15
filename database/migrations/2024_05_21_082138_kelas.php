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
        Schema::create('kelas', function(Blueprint $table){
            $table->id();
            $table->string('id_kelas')->unique();
            $table->string('nama_kelas',25);
            $table->unsignedBigInteger('id_wali');

            $table->foreign('id_wali')->references('id')->on('data_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas',function (Blueprint $table){
            $table->dropForeign(['id_wali']);
            $table->dropColumn('id_wali');
        });

        Schema::dropIfExists('kelas');
    }
};
