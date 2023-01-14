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
    Schema::create('toko_sparepart', function (Blueprint $table) {
      $table->id('id_toko_sparepart');
      $table->foreignId('id_user');
      $table->foreign('id_user')->references('id_user')->on('user');
      $table->char('nama_toko_sparepart', 40);
      $table->char('alamat_toko_sparepart', 100);
      $table->string('deskripsi_toko_sparepart', 1000);
      $table->date('tanggal_berdiri');
      $table->text('foto_surat_izin');
      $table->text('foto_toko_sparepart');
      $table->text('lokasi_toko_sparepart');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('toko_sparepart');
  }
};
