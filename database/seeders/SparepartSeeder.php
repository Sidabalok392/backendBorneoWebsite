<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SparepartSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 1,
      'kode_sparepart' => 'MT-01',
      'nama_sparepart' => 'Mesin Truck',
      'harga_sparepart' => 58000000,
      'jumlah_unit' => 3,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 2,
      'kode_sparepart' => 'B-01',
      'nama_sparepart' => 'Ban Pickup',
      'harga_sparepart' => 1500000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 2,
      'kode_sparepart' => 'B-02',
      'nama_sparepart' => 'Ban Truck',
      'harga_sparepart' => 3650000,
      'jumlah_unit' => 69,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 2,
      'kode_sparepart' => 'B-03',
      'nama_sparepart' => 'Ban Forklift',
      'harga_sparepart' => 5200000,
      'jumlah_unit' => 23,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 3,
      'kode_sparepart' => 'BPR-01',
      'nama_sparepart' => 'Bumper Depan Pickup',
      'harga_sparepart' => 250000,
      'jumlah_unit' => 80,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 3,
      'kode_sparepart' => 'BPR-02',
      'nama_sparepart' => 'Bumper Depan truck',
      'harga_sparepart' => 350000,
      'jumlah_unit' => 55,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 4,
      'kode_sparepart' => 'AP-01',
      'nama_sparepart' => 'Aksesoris Pickup',
      'harga_sparepart' => 15000,
      'jumlah_unit' => 500,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 5,
      'kode_sparepart' => 'AAB-001',
      'nama_sparepart' => 'Aksesoris Alat Berat',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 6,
      'kode_sparepart' => 'SPT-061',
      'nama_sparepart' => 'Sparepart 6 - 1',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 6,
      'kode_sparepart' => 'SPT-062',
      'nama_sparepart' => 'Sparepart 6 - 2',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 7,
      'kode_sparepart' => 'SPT-071',
      'nama_sparepart' => 'Sparepart 7 - 1',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 7,
      'kode_sparepart' => 'SPT-072',
      'nama_sparepart' => 'Sparepart 7 - 2',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 7,
      'kode_sparepart' => 'SPT-073',
      'nama_sparepart' => 'Sparepart 7 - 3',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 8,
      'kode_sparepart' => 'SPT-081',
      'nama_sparepart' => 'Sparepart 8 - 1',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 9,
      'kode_sparepart' => 'SPT-091',
      'nama_sparepart' => 'Sparepart 9 - 1',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 9,
      'kode_sparepart' => 'SPT-092',
      'nama_sparepart' => 'Sparepart 9 - 2',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 9,
      'kode_sparepart' => 'SPT-093',
      'nama_sparepart' => 'Sparepart 9 - 3',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);

    DB::table('sparepart')->insert([
      'id_toko_sparepart' => 9,
      'kode_sparepart' => 'SPT-094',
      'nama_sparepart' => 'Sparepart 9 - 4',
      'harga_sparepart' => 200000,
      'jumlah_unit' => 100,
      'foto_sparepart' => 'https://picsum.photos/200/300',
    ]);
  }
}
