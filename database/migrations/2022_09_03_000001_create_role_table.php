<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::drop('oauth_access_tokens');
    Schema::drop('oauth_auth_codes');
    Schema::drop('oauth_clients');
    Schema::drop('oauth_personal_access_clients');
    Schema::drop('oauth_refresh_tokens');
    Schema::drop('personal_access_tokens');

    Storage::deleteDirectory('public');

    Schema::create('role', function (Blueprint $table) {
      $table->id('id_role');
      $table->char('nama_role', 25);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('role');
  }
};
