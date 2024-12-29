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
        // Schema::table('users', function (Blueprint $table) {
        //     $table->foreignId('lokasi_id')->constrained('lokasi', 'id_lokasi')->onDelete('cascade'); // Tambahkan foreign key
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn('fullname');
        //     $table->dropColumn('role');
        //     $table->dropColumn('foto');
        //     $table->dropColumn('nomor_hp');
        //     $table->dropColumn('is_active');
        //     $table->dropForeign(['lokasi_id']);
        //     $table->dropColumn('lokasi_id');
        // });
    }
};
