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
        Schema::create('jadwal',function(Blueprint $table){
            $table->id();
            $table->string('kode_jadwal',50);
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_hari');
            $table->string('jam',25);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_mapel')->references('id')->on('mapel');
            $table->foreign('id_hari')->references('id')->on('hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal',function(Blueprint $table){
            $table->dropForeign(['id_mapel'],['id_hari']);
            $table->dropColumn('id_wali');
            $table->dropColumn('id_hari');
        });

        Schema::dropIfExist('jadwal');
    }
};
