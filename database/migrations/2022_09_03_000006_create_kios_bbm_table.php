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
    Schema::create('kios_bbm', function (Blueprint $table) {
      $table->id('id_kios_bbm');
      $table->foreignId('id_user');
      $table->foreign('id_user')->references('id_user')->on('user');
      $table->char('nama_kios_bbm', 40);
      $table->char('alamat_kios_bbm', 100);
      $table->string('deskripsi_kios_bbm', 1000);
      $table->date('tanggal_berdiri');
      $table->text('foto_surat_izin');
      $table->text('foto_kios_bbm');
      $table->text('lokasi_kios_bbm');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('kios_bbm');
  }
};
