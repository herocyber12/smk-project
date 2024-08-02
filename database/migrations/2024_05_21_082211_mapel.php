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
        Schema::create('mapel',function (Blueprint $table){
            $table->id();
            $table->string('nama_mapel',100);
            $table->unsignedBigInteger('guru_pengapu');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('guru_pengapu')->references('id')->on('data_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapel');
    }
};
