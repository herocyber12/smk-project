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
        Schema::create('transaksi_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('id_pendaftar');
            $table->integer('amount');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_pendaftar')->references('id')->on('pendaftaran');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_pendaftaran');
    }
};
