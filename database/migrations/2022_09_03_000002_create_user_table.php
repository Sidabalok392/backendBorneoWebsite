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
    Schema::create('user', function (Blueprint $table) {
      $table->id('id_user');
      $table->foreignId('id_role');
      $table->foreign('id_role')->references('id_role')->on('role');
      $table->char('nama_depan', 20);
      $table->char('nama_belakang', 40)->nullable();
      $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
      $table->date('tanggal_lahir');
      $table->text('foto_profil')->default('https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/800px-User_icon_2.svg.png');
      $table->text('foto_ktp')->nullable();
      $table->char('alamat', 100)->nullable();
      $table->char('nomor_hp', 13)->unique(); //08XXXXXXXX <YYY>
      $table->char('email', 50)->unique();
      $table->char('password', 100);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user');
  }
};
