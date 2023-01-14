<?php

namespace Database\Seeders;

use App\Models\Armada;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('order')->insert([
      'id_user' => 23,
      'status' => 'Gagal',
      'tanggal_konfirmasi' => null,
    ]);

    DB::table('order')->insert([
      'id_user' => 23,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);

    DB::table('order')->insert([
      'id_user' => 23,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);

    DB::table('order')->insert([
      'id_user' => 24,
      'status' => 'Gagal',
      'tanggal_konfirmasi' => null,
    ]);

    DB::table('order')->insert([
      'id_user' => 25,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);

    DB::table('order')->insert([
      'id_user' => 26,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);

    DB::table('order')->insert([
      'id_user' => 26,
      'status' => 'Gagal',
      'tanggal_konfirmasi' => null,
    ]);

    DB::table('order')->insert([
      'id_user' => 26,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);

    DB::table('order')->insert([
      'id_user' => 26,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);

    DB::table('order')->insert([
      'id_user' => 27,
      'status' => 'Gagal',
      'tanggal_konfirmasi' => null,
    ]);

    DB::table('order')->insert([
      'id_user' => 27,
      'status' => 'Berhasil',
      'tanggal_konfirmasi' => Carbon::now(),
    ]);
  }
}
