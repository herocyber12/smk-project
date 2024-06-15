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
            $table->bigInteger('no_hp');
            $table->string('email',150)->unique();
            $table->string('id_kelas');
            $table->string('path_foto',150);
            $table->boolean('is_lulus')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_murid');
    }
};
