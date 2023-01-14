<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KiosBBMSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('kios_bbm')->insert([
      'id_user' => 18,
      'nama_kios_bbm' => 'Sobatkom Kiosk XY 1',
      'alamat_kios_bbm' => 'Jl Jend Sudirman Kav 61-62 Ged Summitmas I, Dki Jakarta',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Sobatkom Kiosk XY Ke - 1',
      'tanggal_berdiri' => '1959-12-30',
      'foto_surat_izin' => 'https://perizinan.deliserdangkab.go.id/files/large/a9bb7fa0d825194',
      'foto_kios_bbm' => 'https://asset.kompas.com/crops/TFKu9-usLrjqiEZbeAtOvo5jJmA=/0x0:0x0/750x500/data/photo/2016/07/01/0302160Pertaminip.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 18,
      'nama_kios_bbm' => 'Sobatkom Kiosk XY 2',
      'alamat_kios_bbm' => 'Jl Margomulyo Permai Bl N/23 A, Jawa Timur',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Sobatkom Kiosk XY Ke - 2',
      'tanggal_berdiri' => '1993-12-21',
      'foto_surat_izin' => 'https://pelayanan.denpasarkota.go.id/portal/uploads/post/3c8fb1dbb728ff241ebd89744d36ae2a.jpg',
      'foto_kios_bbm' => 'https://cdn-2.tstatic.net/kupang/foto/bank/images/bbm-eceran-di-kios-kios-di-kota-kupang-ludes.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 18,
      'nama_kios_bbm' => 'Sobatkom Kiosk XY 3',
      'alamat_kios_bbm' => 'Jl Kamboja 5, Dki Jakarta',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Sobatkom Kiosk XY Ke - 3',
      'tanggal_berdiri' => '1996-10-12',
      'foto_surat_izin' => 'https://fahmifebi.com/wp-content/uploads/2019/08/contoh-surat-izin-sakit-yang-dibuat-sendiri.png',
      'foto_kios_bbm' => 'http://ketapangnews.com/wp-content/uploads/2017/01/Kios-BBM-Ilustrasi.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 18,
      'nama_kios_bbm' => 'Sobatkom Kiosk XY 4',
      'alamat_kios_bbm' => 'Jl Holis 147, Jawa Barat',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Sobatkom Kiosk XY Ke - 4',
      'tanggal_berdiri' => '1978-03-10',
      'foto_surat_izin' => 'https://karyatulisilmiah.com/wp-content/uploads/2020/07/contoh-surat-izin-tidak-masuk-kerja-karena-acara-keluarga-contoh-surat-izin-kerja.jpg',
      'foto_kios_bbm' => 'https://cdn-2.tstatic.net/banjarmasin/foto/bank/images/ilustrasi-bbm_20160112_190804.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 19,
      'nama_kios_bbm' => 'Bayu Nur Alfi Jaya Darat',
      'alamat_kios_bbm' => 'johar no.7, Dki Jakarta',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Bayu Nur Alfi Jaya Darat Ke - 1',
      'tanggal_berdiri' => '1991-09-13',
      'foto_surat_izin' => 'https://blogpictures.99.co/7-24.jpg',
      'foto_kios_bbm' => 'https://binabangunbangsa.com/wp-content/uploads/2015/02/Pertamini2_zpsec148a6d.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 20,
      'nama_kios_bbm' => 'Ranggeng Rifat BBM Master',
      'alamat_kios_bbm' => 'Jl Gedong Panjang 19, Dki Jakarta',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Ranggeng Rifat BBM Master Ke - 1',
      'tanggal_berdiri' => '1995-01-01',
      'foto_surat_izin' => 'https://blogpictures.99.co/6-26.jpg',
      'foto_kios_bbm' => 'https://static.republika.co.id/uploads/images/inpicture_slide/spbu-pertamina-_140615232334-633.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 21,
      'nama_kios_bbm' => 'Billy Bumblebee Sifulan BBM 1',
      'alamat_kios_bbm' => 'Jl Trunojoyo 3, Dki Jakarta',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Billy Bumblebee Sifulan BBM Ke - 1',
      'tanggal_berdiri' => '2004-08-22',
      'foto_surat_izin' => 'https://www.seputarpengetahuan.co.id/wp-content/uploads/2020/05/Surat-Izin-Sakit-.png',
      'foto_kios_bbm' => 'https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1527663228/vu4ocrrhnrojdl4qyna7.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 21,
      'nama_kios_bbm' => 'Billy Bumblebee Sifulan BBM 2',
      'alamat_kios_bbm' => 'JL. Lengkong Besar 4, Bandung',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Billy Bumblebee Sifulan BBM Ke - 2',
      'tanggal_berdiri' => '1963-01-07',
      'foto_surat_izin' => 'https://www.akseleran.co.id/blog/wp-content/uploads/2020/04/Contoh-Surat-Tempat-Izin-Usaha.jpg',
      'foto_kios_bbm' => 'https://static.republika.co.id/uploads/images/inpicture_slide/petugas-pertamina-memperagakan-pengisian-bbm-kemasan-di-kios-pertamina-_190516173156-283.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);

    DB::table('kios_bbm')->insert([
      'id_user' => 22,
      'nama_kios_bbm' => 'Targa Bay Kios 1',
      'alamat_kios_bbm' => 'Jl Letjen South Parman Bl H/9, Dki Jakarta',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Targa Bay Kios Ke - 1',
      'tanggal_berdiri' => '1950-09-26',
      'foto_surat_izin' => 'https://karyatulisilmiah.com/wp-content/uploads/2020/07/contoh-surat-ijin-mengikuti-kegiatan-diluar-sekolah-belajar-office-contoh-surat-izin-tidak-masuk-sekolah.jpg',
      'foto_kios_bbm' => 'https://www.rmoljawatengah.id/uploads/images/2018/06/928999_01241403062018_815451_10211703062018_BBM-Eceran-Di-KiosK.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);
    DB::table('kios_bbm')->insert([
      'id_user' => 22,
      'nama_kios_bbm' => 'Targa Bay Kios 2',
      'alamat_kios_bbm' => 'Jl Dr Wahidin 119 A, Sumatera Utara',
      'deskripsi_kios_bbm' => 'Kios BBM Milik Targa Bay Kios Ke - 2',
      'tanggal_berdiri' => '1990-12-21',
      'foto_surat_izin' => 'https://www.hashmicro.com/id/blog/wp-content/uploads/2022/02/contoh-surat-izin-2-scaled.jpg',
      'foto_kios_bbm' => 'https://cdn0-production-images-kly.akamaized.net/OswLopoMxTGJmBYuYjLXcbRPs0U=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/1632868/original/017280100_1498230173-Isi-BBM_-Antrean-Pemudik-Motor-Mengular-di-Indramayu3.jpg',
      'lokasi_kios_bbm' => 'www.google.com'
    ]);
  }
}
