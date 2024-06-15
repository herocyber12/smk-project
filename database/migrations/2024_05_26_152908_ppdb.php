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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('jalur_pendaftaran',25);
            $table->string('prodi',25);
            $table->string('nama_lengkap',125);
            $table->string('jenis_kelamin',40);
            $table->string('tempat_lahir',20);
            $table->date('tanggal_lahir',40);
            $table->text('alamat');
            $table->string('no_hp',13);
            $table->string('asal_sekolah',45);
            $table->text('alamat_asal_sekolah');
            $table->year('tahun_lulus');
            $table->string('nama_ayah',75);
            $table->string('nama_ibu',75);
            $table->text('alamat_tempat_tinggal_ortu');
            $table->string('no_hp_ortu',13);
            $table->string('nama_wali',75)->nullable();
            $table->text('alamat_tempat_tinggal_wali')->nullable();
            $table->string('no_hp_wali',13)->nullable();
            $table->json('info_ppdb');
            $table->json('kelengkapan_dokumen');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
