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
        Schema::create('data_murid',function (Blueprint $table){
            $table->id();
            $table->string('kode_profile',50)->unique();
            $table->string('nama',75);
            $table->string('alamat',150);
            $table->string('no_hp',50);
            $table->string('id_kelas',25)->nullable();
            $table->string('path_foto',150)->nullable();
            $table->boolean('is_lulus')->nullable();
            $table->bigInteger('tahun_angkatan')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_kelas')->references('nama_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas',function (Blueprint $table){
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
            $table->dropForeign(['id_kelas']);
            $table->dropColumn('id_kelas');
        });
        Schema::dropIfExists('data_murid');
    }
};
