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
        Schema::create('absen_murid',function(Blueprint $table){
            $table->id();
            $table->string('kode_absen',50);
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_murid');
            $table->boolean('is_absen');
            $table->string('tanggal',25);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_mapel')->references('id')->on('mapel');
            $table->foreign('id_murid')->references('id')->on('data_murid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absen_murid',function(Blueprint $table){
            $table->dropForeign(['id_murid'],['id_mapel']);
            $table->dropColumn('id_murid');
            $table->dropColumn('id_mapel');
        });

        Schema::dropIfExist('absen_murid');
    }
};
