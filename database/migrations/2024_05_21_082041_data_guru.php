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
        Schema::create('data_guru',function (Blueprint $table){
            $table->id();
            $table->string('kode_guru')->unique();
            $table->string('nama',75);
            $table->string('alamat',150)->nullable();
            $table->string('no_hp',13)->nullable();
            $table->string('path_foto',150)->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_guru', function (Blueprint $table){
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });

        Schema::dropIfExists('data_guru');
    }
};
