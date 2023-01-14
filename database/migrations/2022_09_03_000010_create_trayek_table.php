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
    Schema::create('trayek', function (Blueprint $table) {
      $table->id('id_trayek');
      $table->foreignId('id_armada');
      $table->foreign('id_armada')->references('id_armada')->on('armada');
      $table->float('jarak_tempuh', false); //Kilometer
      $table->float('waktu_tempuh', false); //Jam
      $table->char('jenis_muatan', 40);
      $table->float('konsumsi_bahan_bakar', false); //Liter
      $table->unsignedInteger('uang_perjalanan', false); //Rupiah
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('trayek');
  }
};
