<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JualBeliSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('jual_beli')->insert([
      'merk' => "Toyota Avanza",
      'tipe' => '1.5 New Veloz Q',
      'tahun' => '2015',
      'foto_mobil' => 'https://cdn-2.tstatic.net/batam/foto/bank/images/ilustrasi-toyota-avanza-bekas.jpg',
      'pemilik' => 'Pertama',
      'lokasi' => 'link_maps',
      'kapasitas_mesin' => '1300',
      'tanggal_inspeksi' => '2022-04-01',
      'riwayat' => 100,
      'jenis_bahan_bakar' => 'Bensin',
      'jenis_transmisi' => 'Manual',
      'pajak_berlaku_hingga' => '2025-02-01',
      'harga' => 160000000,
    ]);

    DB::table('jual_beli')->insert([
      'merk' => " Honda HR-V",
      'tipe' => 'PRESTIGE 1.8',
      'tahun' => '2015',
      'foto_mobil' => 'https://imgx.gridoto.com/crop/0x0:0x0/700x465/photo/2019/11/22/3863322827.jpg',
      'pemilik' => 'Pertama',
      'lokasi' => 'Jakarta Utara',
      'kapasitas_mesin' => '1500',
      'tanggal_inspeksi' => '2022-01-01',
      'riwayat' => 'Pemakaian tangan pertama oleh pemilik',
      'jenis_bahan_bakar' => 'Bensin',
      'jenis_transmisi' => 'Matic',
      'pajak_berlaku_hingga' => '2024-02-05',
      'harga' => 243000000,
    ]);

    DB::table('jual_beli')->insert([
      'merk' => 'Mitsubishi XPANDER',
      'tipe' => 'SPORT 1.5',
      'tahun' => '2018',
      'foto_mobil' => 'https://imgx.gridoto.com/crop/0x0:0x0/700x465/filters:watermark(file/2017/gridoto/img/watermark.png,5,5,60)/photo/2020/08/12/74685117.jpeg',
      'pemilik' => 'Pertama',
      'lokasi' => 'Sleman Yogyakarta',
      'kapasitas_mesin' => '1500',
      'tanggal_inspeksi' => '2022-07-08',
      'riwayat' => 'Pemakaian tangan pertama oleh pemilik',
      'jenis_bahan_bakar' => 'Bensin',
      'jenis_transmisi' => 'Matic',
      'pajak_berlaku_hingga' => '2024-01-07',
      'harga' => 204000000,
    ]);

    DB::table('jual_beli')->insert([
      'merk' => 'Mitsubishi PAJERO SPORT ',
      'tipe' => 'DAKAR 4X2 2.4',
      'tahun' => '2018',
      'foto_mobil' => 'https://img.cintamobil.com/2021/10/27/20211027103437-e8d0.png',
      'pemilik' => 'Pertama',
      'lokasi' => 'Jakarta Selatan',
      'kapasitas_mesin' => '2400',
      'tanggal_inspeksi' => '2022-02-011',
      'riwayat' => 'Pemakaian tangan pertama oleh pemilik',
      'jenis_bahan_bakar' => 'Solar',
      'jenis_transmisi' => 'Matic',
      'pajak_berlaku_hingga' => '2028-02-01',
      'harga' => 452000000,
    ]);

    DB::table('jual_beli')->insert([
      'merk' => 'Toyota FORTUNER',
      'tipe' => 'G 2.5',
      'tahun' => '2015',
      'foto_mobil' => 'https://img.cintamobil.com/crop/490x310/2022/04/25/20220425104352-6f61.jpg',
      'pemilik' => 'Pertama',
      'lokasi' => 'Jepara',
      'kapasitas_mesin' => '2500',
      'tanggal_inspeksi' => '2022-03-07',
      'riwayat' => 'Pemakaian tangan pertama oleh pemilik',
      'jenis_bahan_bakar' => 'Solar',
      'jenis_transmisi' => 'Matic',
      'pajak_berlaku_hingga' => '2024-01-07',
      'harga' => 283000000,
    ]);

    DB::table('jual_beli')->insert([
      'merk' => 'Mazda CX-3',
      'tipe' => 'GT 2.0',
      'tahun' => '2019',
      'foto_mobil' => 'https://img5.icarcdn.com/1605937/gallery_used-car-mobil123-mazda-cx-3-touring-wagon-indonesia_000001605937_3a36d8ef_615b_4e5a_b98e_f90e50a73e86.jpg?smia=xTM',
      'pemilik' => 'Pertama',
      'lokasi' => 'Yogyakarta',
      'kapasitas_mesin' => '2000',
      'tanggal_inspeksi' => '2022-05-05',
      'riwayat' => 'Pemakaian tangan pertama oleh pemilik',
      'jenis_bahan_bakar' => 'Bensin',
      'jenis_transmisi' => 'Matic',
      'pajak_berlaku_hingga' => '2025-02-01',
      'harga' => 314000000,
    ]);
  }
}
