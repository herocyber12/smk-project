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
        Schema::create('absen_guru',function(Blueprint $table){
            $table->id();
            $table->string('id_absen',50);
            $table->unsignedBigInteger('id_guru');
            $table->boolean('is_absen');
            $table->string('tanggal',25);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_guru')->references('id')->on('data_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absen_guru',function(Blueprint $table){
            $table->dropForeign(['id_guru']);
            $table->dropColumn('id_guru');
        });

        Schema::dropIfExist('absen_guru');
    }
};
