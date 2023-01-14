<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('armada', function (Blueprint $table) {
      $table->id('id_armada');
      $table->foreignId('id_user');
      $table->foreign('id_user')->references('id_user')->on('user');
      $table->enum('jenis_kendaraan', ['Kecil', 'Truk', 'Alat Berat']);
      $table->char('merk_kendaraan', 30);
      $table->char('plat_nomor', 11)->unique();
      $table->char('nomor_mesin', 15)->unique();
      $table->enum('kondisi_mesin', ['Tidak Baik', 'Baik']);
      $table->enum('kondisi_ban', ['Gundul', 'Retak-Retak', 'Baru']);
      $table->enum('kondisi_mobil', ['Butuh Service', 'Baik']);
      $table->unsignedSmallInteger('batas_muatan', false); //Kilogram
      $table->date('tanggal_beli');
      $table->text('foto_armada');
      $table->enum('status', ['Tidak Tersedia', 'Tersedia'])->default('Tersedia');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('armada');
  }
};
