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
        Schema::create('setoran', function (Blueprint $table) {
            $table->id('id_setoran');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_lokasi');
            $table->string('jenis_setoran');
            $table->string('shift');
            $table->float('pendapatan_awal');
            $table->float('pengeluaran');
            $table->float('pendapatan_akhir');
            $table->float('pendapatan_sistem');
            $table->float('selisih_setoran');
            $table->text('keterangan')->nullable();
            $table->datetime('tanggal_transaksi');
            $table->string('nomor_hp');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran');
    }
};
