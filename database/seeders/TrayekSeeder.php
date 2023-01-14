<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrayekSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('trayek')->insert([
      'id_armada' => 1,
      'jarak_tempuh' => 10,
      'waktu_tempuh' => 688,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 180,
      'uang_perjalanan' => 67982500,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 1,
      'jarak_tempuh' => 20,
      'waktu_tempuh' => 823,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 89,
      'uang_perjalanan' => 27053100,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 1,
      'jarak_tempuh' => 30,
      'waktu_tempuh' => 1961,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 187,
      'uang_perjalanan' => 97094700,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 2,
      'jarak_tempuh' => 40,
      'waktu_tempuh' => 971,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 123,
      'uang_perjalanan' => 33820600,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 2,
      'jarak_tempuh' => 50,
      'waktu_tempuh' => 1042,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 70,
      'uang_perjalanan' => 33323400,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 3,
      'jarak_tempuh' => 60,
      'waktu_tempuh' => 1973,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 49,
      'uang_perjalanan' => 75721600,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 3,
      'jarak_tempuh' => 70,
      'waktu_tempuh' => 898,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 44,
      'uang_perjalanan' => 21242600,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 3,
      'jarak_tempuh' => 80,
      'waktu_tempuh' => 1148,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 46,
      'uang_perjalanan' => 63950500,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 3,
      'jarak_tempuh' => 90,
      'waktu_tempuh' => 1506,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 73,
      'uang_perjalanan' => 71506600,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 4,
      'jarak_tempuh' => 100,
      'waktu_tempuh' => 1350,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 82,
      'uang_perjalanan' => 43606300,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 5,
      'jarak_tempuh' => 10,
      'waktu_tempuh' => 219,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 24,
      'uang_perjalanan' => 74328600,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 5,
      'jarak_tempuh' => 20,
      'waktu_tempuh' => 640,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 90,
      'uang_perjalanan' => 65328600,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 5,
      'jarak_tempuh' => 30,
      'waktu_tempuh' => 1251,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 79,
      'uang_perjalanan' => 81210900,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 5,
      'jarak_tempuh' => 40,
      'waktu_tempuh' => 1935,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 147,
      'uang_perjalanan' => 78276800,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 5,
      'jarak_tempuh' => 50,
      'waktu_tempuh' => 1173,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 127,
      'uang_perjalanan' => 40108200,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 6,
      'jarak_tempuh' => 10,
      'waktu_tempuh' => 1392,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 180,
      'uang_perjalanan' => 54570900,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 6,
      'jarak_tempuh' => 20,
      'waktu_tempuh' => 575,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 182,
      'uang_perjalanan' => 25408700,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 7,
      'jarak_tempuh' => 30,
      'waktu_tempuh' => 975,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 119,
      'uang_perjalanan' => 66181400,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 7,
      'jarak_tempuh' => 40,
      'waktu_tempuh' => 1700,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 19,
      'uang_perjalanan' => 11807900,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 7,
      'jarak_tempuh' => 50,
      'waktu_tempuh' => 1298,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 57,
      'uang_perjalanan' => 42716900,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 8,
      'jarak_tempuh' => 60,
      'waktu_tempuh' => 897,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 28,
      'uang_perjalanan' => 42207200,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 9,
      'jarak_tempuh' => 70,
      'waktu_tempuh' => 275,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 29,
      'uang_perjalanan' => 82658500,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 10,
      'jarak_tempuh' => 80,
      'waktu_tempuh' => 1342,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 107,
      'uang_perjalanan' => 48445500,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 10,
      'jarak_tempuh' => 90,
      'waktu_tempuh' => 1299,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 67,
      'uang_perjalanan' => 10872800,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 10,
      'jarak_tempuh' => 100,
      'waktu_tempuh' => 264,
      'jenis_muatan' => 'Sawit',
      'konsumsi_bahan_bakar' => 22,
      'uang_perjalanan' => 92866100,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 11,
      'jarak_tempuh' => 123,
      'waktu_tempuh' => 1160,
      'jenis_muatan' => 'Batu',
      'konsumsi_bahan_bakar' => 148,
      'uang_perjalanan' => 97955200,
    ]);

    DB::table('trayek')->insert([
      'id_armada' => 11,
      'jarak_tempuh' => 321,
      'waktu_tempuh' => 1649,
      'jenis_muatan' => 'Pasir',
      'konsumsi_bahan_bakar' => 173,
      'uang_perjalanan' => 98835900,
    ]);
  }
}
