<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArmadaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('armada')->insert([
      'id_user' => 8,
      'jenis_kendaraan' => 'Kecil',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 5570 KW',
      'nomor_mesin' => '1111111111',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Baru',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 100,
      'tanggal_beli' => '2001-04-01',
      'foto_armada' => 'https://d2fgf7u961ce77.cloudfront.net/assets/static/img/variant/thumb/Suzuki_Carry_Wide_Deck_Hero_Angle_SIILVER_FIX-min.png',
    ]);

    DB::table('armada')->insert([
      'id_user' => 9,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 557 PD',
      'nomor_mesin' => '1111111112',
      'kondisi_mesin' => 'Tidak Baik',
      'kondisi_ban' => 'Baru',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 1000,
      'tanggal_beli' => '2001-01-12',
      'foto_armada' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Dutro130MDL.JPG/220px-Dutro130MDL.JPG',
    ]);

    DB::table('armada')->insert([
      'id_user' => 9,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 884 YK',
      'nomor_mesin' => '1111111113',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Baru',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 10000,
      'tanggal_beli' => '2002-03-01',
      'foto_armada' => 'https://kirimalatberat.com/wp-content/uploads/2017/11/Komatsu-PC200-8MO-800x480.jpg',
    ]);

    DB::table('armada')->insert([
      'id_user' => 10,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 5344 RL',
      'nomor_mesin' => '1111111114',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Baru',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 1000,
      'tanggal_beli' => '2002-01-11',
      'foto_armada' => 'https://products.unitedtractors.com/wp-content/uploads/2021/05/R560-16050-102-1.png',
    ]);

    DB::table('armada')->insert([
      'id_user' => 10,
      'jenis_kendaraan' => 'Kecil',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 1859 XX',
      'nomor_mesin' => '1111111115',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Gundul',
      'kondisi_mobil' => 'Butuh Service',
      'batas_muatan' => 100,
      'tanggal_beli' => '2003-11-04',
      'foto_armada' => 'https://carnetwork.s3.ap-southeast-1.amazonaws.com/file/c897cbf2054c4d10b758c84f0f0e0a18.jpg',
    ]);

    DB::table('armada')->insert([
      'id_user' => 10,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 5045 UB',
      'nomor_mesin' => '1111111116',
      'kondisi_mesin' => 'Tidak Baik',
      'kondisi_ban' => 'Retak-Retak',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 10000,
      'tanggal_beli' => '1999-01-01',
      'foto_armada' => 'https://i0.wp.com/www.adhyaksapersada.co.id/wp-content/uploads/2019/07/truk-1.jpg?resize=640%2C360&ssl=1',
    ]);

    DB::table('armada')->insert([
      'id_user' => 11,
      'jenis_kendaraan' => 'Kecil',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 7461 NC',
      'nomor_mesin' => '1111111117',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Baru',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 100,
      'tanggal_beli' => '1998-10-25',
      'foto_armada' => 'https://img.indianautosblog.com/2022/07/06/tata-intra-smart-pickup-front-right-4213.jpg',
    ]);

    DB::table('armada')->insert([
      'id_user' => 11,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 9957 OP',
      'nomor_mesin' => '1111111118',
      'kondisi_mesin' => 'Tidak Baik',
      'kondisi_ban' => 'Baru',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 1000,
      'tanggal_beli' => '1998-11-03',
      'foto_armada' => 'https://img.cintamobil.com/2021/03/05/ZXn5Pos1/modifikasi-mobil-truk-2-c112.jpg',
    ]);

    DB::table('armada')->insert([
      'id_user' => 11,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 5326 SK',
      'nomor_mesin' => '1111111119',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Gundul',
      'kondisi_mobil' => 'Butuh Service',
      'batas_muatan' => 1000,
      'tanggal_beli' => '2001-09-12',
      'foto_armada' => 'https://imgcdn.oto.com/medium/gallery/exterior/121/2060/tata-ultra-97016.jpg',
    ]);

    DB::table('armada')->insert([
      'id_user' => 11,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 7631 TR',
      'nomor_mesin' => '1111111120',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Retak-Retak',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 1000,
      'tanggal_beli' => '2001-04-21',
      'foto_armada' => 'https://awsimages.detik.net.id/community/media/visual/2017/02/12/4451300c-6884-4064-b8c1-d07133ff2391_43.jpg?w=700&q=90',
    ]);

    DB::table('armada')->insert([
      'id_user' => 12,
      'jenis_kendaraan' => 'Truk',
      'merk_kendaraan' => 'hiyundai',
      'plat_nomor' => 'AB 9499 LG',
      'nomor_mesin' => '1111111121',
      'kondisi_mesin' => 'Baik',
      'kondisi_ban' => 'Retak-Retak',
      'kondisi_mobil' => 'Baik',
      'batas_muatan' => 10000,
      'tanggal_beli' => '2000-09-09',
      'foto_armada' => 'https://cdns.klimg.com/resized/1200x600/p/headline/8-jenis-alat-berat-untuk-proyek-banguna-11068c.jpg',
    ]);
  }
}
