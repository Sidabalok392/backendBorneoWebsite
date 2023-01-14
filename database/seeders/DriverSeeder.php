<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('driver')->insert([
      'id_user' => 3,
      'pengalaman' => '3 tahun menjadi sopir',
      'foto_sim' => 'https://www.tokotalk.com/help/wp-content/uploads/2020/08/identity_card_example.b686f703-1024x664.jpg',
    ]);

    DB::table('driver')->insert([
      'id_user' => 4,
      'pengalaman' => '4 tahun menjadi sopir',
      'foto_sim' => 'https://akcdn.detik.net.id/visual/2019/02/26/60057df6-b526-4732-8e75-c07948cd5e39_169.jpeg?w=650',
    ]);

    DB::table('driver')->insert([
      'id_user' => 5,
      'pengalaman' => '5 tahun menjadi sopir',
      'foto_sim' => 'https://imgx.motorplus-online.com/crop/0x0:0x0/700x465/photo/2021/03/14/ktp_20170928_191900jpg-20210314105658.jpg',
    ]);

    DB::table('driver')->insert([
      'id_user' => 6,
      'pengalaman' => '6 tahun menjadi sopir',
      'foto_sim' => 'https://tlogohaji-bjn.desa.id/wp-content/uploads/2019/08/HHHJ.png',
    ]);

    DB::table('driver')->insert([
      'id_user' => 7,
      'pengalaman' => '7 tahun menjadi sopir',
      'foto_sim' => 'https://wahananews.co/photo/thumbs/wahananews/dir112021/ktp-vanessa-angel-tercecer-di-lokasi-kecelakaan_L18bfL3LK9.jpg',
    ]);
  }
}
