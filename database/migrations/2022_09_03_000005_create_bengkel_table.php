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
    Schema::create('bengkel', function (Blueprint $table) {
      $table->id('id_bengkel');
      $table->foreignId('id_user');
      $table->foreign('id_user')->references('id_user')->on('user');
      $table->char('nama_bengkel', 40);
      $table->char('alamat_bengkel', 100);
      $table->string('deskripsi_bengkel', 1000);
      $table->date('tanggal_berdiri');
      $table->text('foto_surat_izin');
      $table->text('foto_bengkel');
      $table->text('lokasi_bengkel');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('bengkel');
  }
};
