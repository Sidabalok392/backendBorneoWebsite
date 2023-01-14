<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BengkelSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('bengkel')->insert([
      'id_user' => 13,
      'nama_bengkel' => 'Alias Wello Bengkel 1',
      'alamat_bengkel' => 'Jl Pandanaran 63, Jawa Tengah',
      'deskripsi_bengkel' => 'Bengkel Milik Alias Wello Ke - 1',
      'tanggal_berdiri' => '1963-01-07',
      'foto_surat_izin' => 'https://cdn.idntimes.com/content-images/post/20220418/perihal-1-9f17501fb40e6bb2d50dfcb69b3ab658.jpg',
      'foto_bengkel' => 'https://assets.kompasiana.com/items/album/2020/09/12/motor2-5f5c4f64d541df5c327a59d2.jpg?t=o&v=770',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 13,
      'nama_bengkel' => 'Alias Wello Bengkel 2',
      'alamat_bengkel' => 'Jl Murbei 3 Semarang, Jawa Tengah',
      'deskripsi_bengkel' => 'Bengkel Milik Alias Wello Ke - 2',
      'tanggal_berdiri' => '1950-09-26',
      'foto_surat_izin' => 'https://blogpictures.99.co/1-52.jpg',
      'foto_bengkel' => 'https://imgx.gridoto.com/crop/0x0:0x0/700x500/filters:watermark(file/2017/gridoto/img/watermark.png,5,5,60)/photo/2020/12/19/3411804514.png',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 14,
      'nama_bengkel' => 'Tuhan Jaya',
      'alamat_bengkel' => 'Jl Batang Kuis 2 AA, Sumatera Utara',
      'deskripsi_bengkel' => 'Bengkel Milik Tuhan Ke - 1',
      'tanggal_berdiri' => '1990-12-21',
      'foto_surat_izin' => 'https://blogpictures.99.co/3-5.png',
      'foto_bengkel' => 'https://imgx.gridoto.com/crop/0x0:0x0/700x465/filters:watermark(file/2017/gridoto/img/watermark.png,5,5,60)/photo/gridoto/2017/10/13/2370856391.jpg',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 15,
      'nama_bengkel' => 'Debby Anggraini Bengkel 1',
      'alamat_bengkel' => 'Jl RA Kartini 26 Ventura Bldg 4th Fl Suite 405, Dki Jakarta',
      'deskripsi_bengkel' => 'Bengkel Milik Debby Angraini Ke - 1',
      'tanggal_berdiri' => '1964-05-20',
      'foto_surat_izin' => 'https://cdn-2.tstatic.net/tribunnews/foto/bank/images/cara-membuat-surat-izin-sekolah.jpg',
      'foto_bengkel' => 'https://cdn0-production-images-kly.akamaized.net/B6cZwZ_jliGxcmcw91CPikwlpHk=/1200x1200/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/1626208/original/025759600_1497611620-Bengkel-Motor-Kebanjiran-Order1.jpg',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 15,
      'nama_bengkel' => 'Debby Anggraini Bengkel 2',
      'alamat_bengkel' => 'Jl Yudistira 17 RT 006/01, Jawa Tengah',
      'deskripsi_bengkel' => 'Bengkel Milik Debby Angraini Ke - 2',
      'tanggal_berdiri' => '1968-04-21',
      'foto_surat_izin' => 'https://blogpictures.99.co/2-32.jpg',
      'foto_bengkel' => 'https://awsimages.detik.net.id/community/media/visual/2020/12/01/bengkel-petrikbike-di-bekasi-bisa-ubah-motor-bensin-jadi-motor-listrik_43.jpeg?w=700&q=90',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 15,
      'nama_bengkel' => 'Debby Anggraini Bengkel 3',
      'alamat_bengkel' => ' Jl South Wiryopranoto 30-36, Jakarta',
      'deskripsi_bengkel' => 'Bengkel Milik Debby Angraini Ke - 3',
      'tanggal_berdiri' => '1999-10-06',
      'foto_surat_izin' => 'https://cdn1-production-images-kly.akamaized.net/7IT95i79o25DgyFkTMoSkUrBg9s=/640x360/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/2813864/original/032951300_1558601621-surat_izin_3.jpg',
      'foto_bengkel' => 'https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1634025439/01g7vh1337yg8nyy7cgp2de3b9.jpg',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 16,
      'nama_bengkel' => 'Saidi Jaya Berkah',
      'alamat_bengkel' => 'Jl Irigasi 9, Jakarta',
      'deskripsi_bengkel' => 'Bengkel Milik Saidi Ke - 1',
      'tanggal_berdiri' => '1959-12-30',
      'foto_surat_izin' => 'https://ecs7.tokopedia.net/blog-tokopedia-com/uploads/2021/06/4.-Contoh-Surat-Izin-Tidak-Masuk-Kerja-untuk-Menikah.jpg',
      'foto_bengkel' => 'https://asset.kompas.com/crops/UpmQGaUMYVU_D2bqQdMquCZToTc=/0x0:780x390/750x500/data/photo/2016/11/28/1252421IMG-20161128-113143-2780x390.jpg',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 17,
      'nama_bengkel' => 'Yanto Tam 1',
      'alamat_bengkel' => 'Jl Raya Mampang Prapatan 28, Dki Jakarta',
      'deskripsi_bengkel' => 'Bengkel Milik Yanto Ke - 1',
      'tanggal_berdiri' => '1993-12-21',
      'foto_surat_izin' => 'https://karyatulisilmiah.com/wp-content/uploads/2020/07/contoh-surat-tidak-masuk-sekolah-karena-sakit-yang-baik-belajar-contoh-surat-izin-tidak-masuk-sekolah.jpg',
      'foto_bengkel' => 'https://awsimages.detik.net.id/community/media/visual/2020/06/26/bengkel-umum-di-mampang-7_169.jpeg?w=700&q=90',
      'lokasi_bengkel' => 'www.google.com'
    ]);

    DB::table('bengkel')->insert([
      'id_user' => 17,
      'nama_bengkel' => 'Yanto Tam 2',
      'alamat_bengkel' => ' Mall Taman Anggrek Lot No. E25-26 JL. Letjend S Parman Kav. 21, Slipi',
      'deskripsi_bengkel' => 'Bengkel Milik Yanto Ke - 2',
      'tanggal_berdiri' => '1996-10-12',
      'foto_surat_izin' => 'https://i.ytimg.com/vi/GXvSgv1zfs8/maxresdefault.jpg',
      'foto_bengkel' => 'https://tribratanewsntt.com/uploads/images/image_750x_61cc09bab336f.jpg',
      'lokasi_bengkel' => 'www.google.com'
    ]);
  }
}
