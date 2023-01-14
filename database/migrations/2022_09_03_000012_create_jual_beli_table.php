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
    Schema::create('jual_beli', function (Blueprint $table) {
      $table->id('id_jual_beli');
      $table->char('merk', 30);
      $table->char('tipe', 30);
      $table->year('tahun');
      $table->text('foto_mobil');
      $table->char('pemilik', 50);
      $table->text('lokasi');
      $table->smallInteger('kapasitas_mesin', false);
      $table->date('tanggal_inspeksi');
      $table->char('riwayat', 100);
      $table->char('jenis_bahan_bakar', 30);
      $table->char('jenis_transmisi', 30);
      $table->date('pajak_berlaku_hingga');
      $table->bigInteger('harga', false);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('jual_beli');
  }
};
