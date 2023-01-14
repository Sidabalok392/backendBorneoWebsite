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
    Schema::create('sparepart', function (Blueprint $table) {
      $table->id('id_sparepart');
      $table->foreignId('id_toko_sparepart');
      $table->foreign('id_toko_sparepart')->references('id_toko_sparepart')->on('toko_sparepart');
      $table->char('kode_sparepart', 10)->default('XXX-000')->unique(); //BRG-001
      $table->char('nama_sparepart', 20);
      $table->unsignedInteger('harga_sparepart', false);
      $table->unsignedSmallInteger('jumlah_unit', false);
      $table->text('foto_sparepart');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('sparepart');
  }
};
