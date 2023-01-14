<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('role')->insert([
      'nama_role' => 'Super Admin', //1
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Admin', //2
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Driver', //3
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Pemilik Armada', //4
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Pemilik Bengkel', //5
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Pemilik Kios BBM', //6
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Pemilik Order', //7
    ]);

    DB::table('role')->insert([
      'nama_role' => 'Pemilik Toko Sparepart', //8
    ]);
  }
}
