<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order', function (Blueprint $table) {
      $table->id('id_order');
      $table->foreignId('id_user');
      $table->foreign('id_user')->references('id_user')->on('user');
      $table->enum('status', ['Gagal', 'Proses', 'Berhasil'])->default('Proses');
      $table->date('tanggal_pemesanan')->default(Carbon::now());
      $table->date('tanggal_konfirmasi')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order');
  }
};
