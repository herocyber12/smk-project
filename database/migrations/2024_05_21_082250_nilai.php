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
        Schema::create('nilai',function(Blueprint $table){
            $table->id();
            $table->string('kode_nilai',50);
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_murid');
            $table->unsignedBigInteger('id_mapel');
            $table->smallInteger('nilai');
            $table->enum('jenis_nilai',['UAS','UTS','Tugas'])->default('Tugas');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->foreign('id_murid')->references('id')->on('data_murid');
            $table->foreign('id_mapel')->references('id')->on('mapel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai',function(Blueprint $table){
            $table->dropForeign(['id_kelas'],['id_murid'],['id_mapel']);
            $table->dropColumn('id_kelas');
            $table->dropColumn('id_murid');
            $table->dropColumn('id_mapel');
        });

        Schema::dropIfExist('nilai');
    }
};
