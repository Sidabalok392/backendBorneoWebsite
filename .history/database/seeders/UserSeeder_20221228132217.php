<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //SUPER ADMIN, ID: 1
    DB::table('user')->insert([
      'id_role' => 1,
      'nama_depan' => 'SUPER',
      'nama_belakang' => 'ADMIN',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1987-03-15',
      'foto_profil' => 'https://tr.rbxcdn.com/e145553757e6f829d0c6523309d770e2/420/420/Image/Png',
      'foto_ktp' => '',
      'alamat' => '',
      'nomor_hp' => '08123456789',
      'email' => 'superadmin@gmail.com',
      'password' => '$2a$12$JipwLIH/200DDm0d2h.OGuWtTEji8uiAga6HsJ4NMqaDExIBIHxL6',
    ]);

    //ADMIN, ID: 2
    DB::table('user')->insert([
      'id_role' => 2,
      'nama_depan' => 'ADMIN',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1987-04-15',
      'foto_profil' => 'https://as1.ftcdn.net/v2/jpg/00/07/32/48/1000_F_7324864_FXazuBCI3dQBwIWY7gaWQzXskXJaTbrY.jpg',
      'foto_ktp' => '',
      'alamat' => '',
      'nomor_hp' => '0812345678901',
      'email' => 'admin@gmail.com',
      'password' => 'admin',
    ]);

    //DRIVER, ID: 3,4,5,6,7
    DB::table('user')->insert([
      'id_role' => 3,
      'nama_depan' => 'Mira',
      'nama_belakang' => 'Setiawan',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1986-02-18',
      'foto_profil' => 'https://static.republika.co.id/uploads/images/inpicture_slide/ilustrasi-ktp-elektronik_220603162409-793.jpg',
      'foto_ktp' => 'https://static.republika.co.id/uploads/images/inpicture_slide/ilustrasi-ktp-elektronik_220603162409-793.jpg',
      'alamat' => 'JL. Pasti Cepat A7/66',
      'nomor_hp' => '083171234567',
      'email' => 'mirasetiawan@gmail.com',
      'password' => 'mira',
    ]);

    DB::table('user')->insert([
      'id_role' => 3,
      'nama_depan' => 'Guohui',
      'nama_belakang' => 'Chen',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1977-03-25',
      'foto_profil' => 'https://akcdn.detik.net.id/visual/2019/02/26/60057df6-b526-4732-8e75-c07948cd5e39_169.jpeg?w=650',
      'foto_ktp' => 'https://akcdn.detik.net.id/visual/2019/02/26/60057df6-b526-4732-8e75-c07948cd5e39_169.jpeg?w=650',
      'alamat' => 'JL. Slamet Perumahan Rancabali No. 40',
      'nomor_hp' => '08320301250',
      'email' => 'guohuichen@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 3,
      'nama_depan' => 'Filani',
      'nama_belakang' => 'Soesilo Ratna Dharmunen',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1999-10-06',
      'foto_profil' => 'https://imgx.motorplus-online.com/crop/0x0:0x0/700x465/photo/2021/03/14/ktp_20170928_191900jpg-20210314105658.jpg',
      'foto_ktp' => 'https://imgx.motorplus-online.com/crop/0x0:0x0/700x465/photo/2021/03/14/ktp_20170928_191900jpg-20210314105658.jpg',
      'alamat' => 'Perum Citra Cempaka',
      'nomor_hp' => '08647206461',
      'email' => 'filaniratna@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 3,
      'nama_depan' => 'Sarni',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1959-12-30',
      'foto_profil' => 'https://tlogohaji-bjn.desa.id/wp-content/uploads/2019/08/HHHJ.png',
      'foto_ktp' => 'https://tlogohaji-bjn.desa.id/wp-content/uploads/2019/08/HHHJ.png',
      'alamat' => 'Dusun Botoputih',
      'nomor_hp' => '083522127012',
      'email' => 'sarni@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 3,
      'nama_depan' => 'Vanesza',
      'nama_belakang' => 'Adzania',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1993-12-21',
      'foto_profil' => 'https://wahananews.co/photo/thumbs/wahananews/dir112021/ktp-vanessa-angel-tercecer-di-lokasi-kecelakaan_L18bfL3LK9.jpg',
      'foto_ktp' => 'https://wahananews.co/photo/thumbs/wahananews/dir112021/ktp-vanessa-angel-tercecer-di-lokasi-kecelakaan_L18bfL3LK9.jpg',
      'alamat' => 'Jl. Testing123',
      'nomor_hp' => '08123123123',
      'email' => 'vaneszaadzania@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    //PEMILIK ARMADA, ID: 8,9,10,11,12
    DB::table('user')->insert([
      'id_role' => 4,
      'nama_depan' => 'Pramudya',
      'nama_belakang' => 'Warganet',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1996-10-12',
      'foto_profil' => 'http://inibaru.id/media/13397/large/normal/8bf2dfe4-3662-43d4-aed9-39047be16f5c__large.jpg',
      'foto_ktp' => 'http://inibaru.id/media/13397/large/normal/8bf2dfe4-3662-43d4-aed9-39047be16f5c__large.jpg',
      'alamat' => 'Jl. Pramudya Warganet',
      'nomor_hp' => '08111111111',
      'email' => 'pramudyawarganet@gmail.com',
      'password' => '1996-10-12',
    ]);

    DB::table('user')->insert([
      'id_role' => 4,
      'nama_depan' => 'Amat',
      'nama_belakang' => 'Faozi',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1978-03-10',
      'foto_profil' => 'https://awsimages.detik.net.id/community/media/visual/2017/07/20/3a1c67e8-064d-4f56-80eb-feced76cad3e_169.jpg?w=700&q=90',
      'foto_ktp' => 'https://awsimages.detik.net.id/community/media/visual/2017/07/20/3a1c67e8-064d-4f56-80eb-feced76cad3e_169.jpg?w=700&q=90',
      'alamat' => 'DUSUN Kauman',
      'nomor_hp' => '081111111112',
      'email' => 'amatfaozi@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 4,
      'nama_depan' => 'Vanka',
      'nama_belakang' => 'Vikri Vaneza',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1991-09-13',
      'foto_profil' => 'https://s3.theasianparent.com/tap-assets-prod/wp-content/uploads/sites/24/2021/06/Foto-KTP-Artis-Valeria-Tifanka.jpg',
      'foto_ktp' => 'https://s3.theasianparent.com/tap-assets-prod/wp-content/uploads/sites/24/2021/06/Foto-KTP-Artis-Valeria-Tifanka.jpg',
      'alamat' => 'Jl VVV no 32',
      'nomor_hp' => '081111111113',
      'email' => 'vankavaneza@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 4,
      'nama_depan' => 'Cewek',
      'nama_belakang' => 'Cantik',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1995-01-01',
      'foto_profil' => 'http://portal.riau24.com/news/20211105/riau24_1636081612.jpg',
      'foto_ktp' => 'http://portal.riau24.com/news/20211105/riau24_1636081612.jpg',
      'alamat' => 'Jl Perum Akan no 43',
      'nomor_hp' => '081111111114',
      'email' => 'cewekcantik@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 4,
      'nama_depan' => 'Tifara',
      'nama_belakang' => 'Putri Emelyn Vidi',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '2004-08-22',
      'foto_profil' => 'http://portal.riau24.com/news/20211012/riau24_1634043395.jpg',
      'foto_ktp' => 'http://portal.riau24.com/news/20211012/riau24_1634043395.jpg',
      'alamat' => 'Jl Duren no 46',
      'nomor_hp' => '081111111115',
      'email' => 'tifaraemelyn@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    //PEMILIK BENGKEL, ID: 13,14,15,16,17
    DB::table('user')->insert([
      'id_role' => 5,
      'nama_depan' => 'Alias',
      'nama_belakang' => 'Wello',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1963-01-07',
      'foto_profil' => 'https://suarasiber.com/wp-content/uploads/2020/10/alias-wello-ktp-bintan-800x445.jpg',
      'foto_ktp' => 'https://suarasiber.com/wp-content/uploads/2020/10/alias-wello-ktp-bintan-800x445.jpg',
      'alamat' => 'JL. Imam Bonjol Kampung Mentigi Laut',
      'nomor_hp' => '082104010701',
      'email' => 'aliaswello@gmail.com',
      'password' => '1963-01-07',
    ]);

    DB::table('user')->insert([
      'id_role' => 5,
      'nama_depan' => 'Tuhan',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1950-09-26',
      'foto_profil' => 'https://makassar.terkini.id/wp-content/uploads/2022/02/terkiniid_screenshot_2022-02-09-13-43-33-439_com.miui_.gallery-696x385.png',
      'foto_ktp' => 'https://makassar.terkini.id/wp-content/uploads/2022/02/terkiniid_screenshot_2022-02-09-13-43-33-439_com.miui_.gallery-696x385.png',
      'alamat' => 'JL. Manyar Ling. Krajan',
      'nomor_hp' => '083509202609',
      'email' => 'tuhan@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 5,
      'nama_depan' => 'Debby',
      'nama_belakang' => 'Anggraini',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1990-12-21',
      'foto_profil' => 'http://1.bp.blogspot.com/-cKbR2Cw8BLU/VrLaPvhz9pI/AAAAAAAAAcE/Pe9LhaTN1sY/s320/Scan%2BKTP.JPG',
      'foto_ktp' => 'http://1.bp.blogspot.com/-cKbR2Cw8BLU/VrLaPvhz9pI/AAAAAAAAAcE/Pe9LhaTN1sY/s320/Scan%2BKTP.JPG',
      'alamat' => 'JL. Kecapi V',
      'nomor_hp' => '083174096112',
      'email' => 'debbyanggraini@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 5,
      'nama_depan' => 'Saidi',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1964-05-20',
      'foto_profil' => 'https://asset.kompas.com/crops/s3E-eXd-i84_BoxItTayewn1TuI=/0x0:0x0/750x500/data/photo/2017/02/04/1902102IMG-20170204-WA0017780x390.jpg',
      'foto_ktp' => 'https://asset.kompas.com/crops/s3E-eXd-i84_BoxItTayewn1TuI=/0x0:0x0/750x500/data/photo/2017/02/04/1902102IMG-20170204-WA0017780x390.jpg',
      'alamat' => 'JL. Lodan Raya No. 12',
      'nomor_hp' => '083173021502',
      'email' => 'saidi@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 5,
      'nama_depan' => 'Yanto',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1968-04-21',
      'foto_profil' => 'https://i.pinimg.com/736x/2e/0e/d0/2e0ed06215cb3a884a13bd7b880a51fe.jpg',
      'foto_ktp' => 'https://i.pinimg.com/736x/2e/0e/d0/2e0ed06215cb3a884a13bd7b880a51fe.jpg',
      'alamat' => 'Gading Serpong 7B DD.7 No. 29',
      'nomor_hp' => '083603282104',
      'email' => 'yanto@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    //PEMILIK KIOS BBM, ID: 18,19,20,21,22
    DB::table('user')->insert([
      'id_role' => 6,
      'nama_depan' => 'Sobatkom',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1994-02-26',
      'foto_profil' => 'https://cloud.jpnn.com/photo/arsip/normal/2021/09/01/tangkapan-layar-contoh-e-ktp-yang-sudah-diberi-watermark-fot-hxj6.jpg',
      'foto_ktp' => 'https://cloud.jpnn.com/photo/arsip/normal/2021/09/01/tangkapan-layar-contoh-e-ktp-yang-sudah-diberi-watermark-fot-hxj6.jpg',
      'alamat' => 'JL. Nin Aja Dulu',
      'nomor_hp' => '083847582934',
      'email' => 'sobatkom@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 6,
      'nama_depan' => 'Bayu',
      'nama_belakang' => 'Alfi Nur',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '2000-12-15',
      'foto_profil' => 'https://statik.tempo.co/data/2018/11/26/id_799592/799592_720.jpg',
      'foto_ktp' => 'https://statik.tempo.co/data/2018/11/26/id_799592/799592_720.jpg',
      'alamat' => 'Dusun Tambakrejo',
      'nomor_hp' => '083509031577',
      'email' => 'bayunuralfi@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 6,
      'nama_depan' => 'Ranggeng',
      'nama_belakang' => 'Rifat',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '2000-04-04',
      'foto_profil' => 'https://cdc.ui.ac.id/wp-content/uploads/2022/07/ktp.jpeg',
      'foto_ktp' => 'https://cdc.ui.ac.id/wp-content/uploads/2022/07/ktp.jpeg',
      'alamat' => 'Kemusuk',
      'nomor_hp' => '083305010404',
      'email' => 'ranggengrifat@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 6,
      'nama_depan' => 'Billy',
      'nama_belakang' => 'Sifulan Bumblebee',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1990-01-01',
      'foto_profil' => 'https://glints.com/id/lowongan/wp-content/uploads/2021/10/watermark.png',
      'foto_ktp' => 'https://glints.com/id/lowongan/wp-content/uploads/2021/10/watermark.png',
      'alamat' => 'JL. Dimana No 100',
      'nomor_hp' => '083175070101',
      'email' => 'billybumblebeesifulan@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 6,
      'nama_depan' => 'Targa',
      'nama_belakang' => 'Bay',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1978-03-19',
      'foto_profil' => 'https://1.bp.blogspot.com/-Wb4DX67_Dn4/YH5Z1HScHSI/AAAAAAAAAtQ/estiRHYKKK07v4UHtgP2WqYuGZF0ng3eACLcBGAsYHQ/s281/Screenshot_5.jpg',
      'foto_ktp' => 'https://1.bp.blogspot.com/-Wb4DX67_Dn4/YH5Z1HScHSI/AAAAAAAAAtQ/estiRHYKKK07v4UHtgP2WqYuGZF0ng3eACLcBGAsYHQ/s281/Screenshot_5.jpg',
      'alamat' => 'Jl. Targa Kepulauan Bay No 01',
      'nomor_hp' => '083313091954',
      'email' => 'targabay@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    //PEMILIK ORDER, ID: 23,24,25,26,27
    DB::table('user')->insert([
      'id_role' => 7,
      'nama_depan' => 'Mawar',
      'nama_belakang' => 'Dwiputri Raissa',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1990-11-08',
      'foto_profil' => 'https://fileproxy.scsusercontent.com/api/v2/files/Y3MtaW5ob3VzZTAx/98f342b403034d768323743a09902842.jpg',
      'foto_ktp' => 'https://fileproxy.scsusercontent.com/api/v2/files/Y3MtaW5ob3VzZTAx/98f342b403034d768323743a09902842.jpg',
      'alamat' => 'JL. Tambak Piring Indah No. 66 Tangerang Selatan',
      'nomor_hp' => '083756281923',
      'email' => 'mawarraissadwiputri@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 7,
      'nama_depan' => 'Yasir',
      'nama_belakang' => 'Nadem',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1984-11-15',
      'foto_profil' => 'https://1.bp.blogspot.com/-IUn1e3lRtVU/WCMI8GBq55I/AAAAAAAAC44/O4w6YhGYD6YK7mvzuMWkTpU661sNtL7YwCEw/s1600/KTP.jpeg',
      'foto_ktp' => 'https://1.bp.blogspot.com/-IUn1e3lRtVU/WCMI8GBq55I/AAAAAAAAC44/O4w6YhGYD6YK7mvzuMWkTpU661sNtL7YwCEw/s1600/KTP.jpeg',
      'alamat' => 'JL. Semeru GG Cempaka',
      'nomor_hp' => '083756682923',
      'email' => 'yasirnadem@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 7,
      'nama_depan' => 'R',
      'nama_belakang' => 'Putri Hesti',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1993-05-15',
      'foto_profil' => 'https://cdn.idntimes.com/content-images/post/20210826/66-7a0a1bbde44af82d253ec6399ae7b54a.jpg',
      'foto_ktp' => 'https://cdn.idntimes.com/content-images/post/20210826/66-7a0a1bbde44af82d253ec6399ae7b54a.jpg',
      'alamat' => 'Jl Jend Sudirman Kav 54-55 Ged Bapindo Tower, Dki Jakarta',
      'nomor_hp' => '0837666271823',
      'email' => 'rhestiputri@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 7,
      'nama_depan' => 'Lukman',
      'nama_belakang' => 'Wijaya',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1989-03-13',
      'foto_profil' => 'https://blog.elevenia.co.id/wp-content/uploads/2021/06/Font-pada-KTP-maupun-e-KTP-479x300.jpg',
      'foto_ktp' => 'https://blog.elevenia.co.id/wp-content/uploads/2021/06/Font-pada-KTP-maupun-e-KTP-479x300.jpg',
      'alamat' => 'JL. Raya Ciseeng No. 12 Blok A',
      'nomor_hp' => '08375761829',
      'email' => 'lukmanwijaya@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 7,
      'nama_depan' => 'Sulistyono',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1966-02-26',
      'foto_profil' => 'https://static.wixstatic.com/media/6a63fe_1c022d3de1544bf4af1f42f2a66e8163~mv2.jpg/v1/fill/w_600,h_391,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/6a63fe_1c022d3de1544bf4af1f42f2a66e8163~mv2.jpg',
      'foto_ktp' => 'https://static.wixstatic.com/media/6a63fe_1c022d3de1544bf4af1f42f2a66e8163~mv2.jpg/v1/fill/w_600,h_391,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/6a63fe_1c022d3de1544bf4af1f42f2a66e8163~mv2.jpg',
      'alamat' => 'JL. Raya - DSN Purwekerto',
      'nomor_hp' => '081728395786',
      'email' => 'sulistyono@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    //PEMILIK TOKO SPAREPART, ID: 28,29,30,31,32
    DB::table('user')->insert([
      'id_role' => 8,
      'nama_depan' => 'Harry',
      'nama_belakang' => 'Pebrianti',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1994-02-01',
      'foto_profil' => 'https://makassar.terkini.id/wp-content/uploads/2021/05/terkiniid_img_20210522_085917.jpg',
      'foto_ktp' => 'https://makassar.terkini.id/wp-content/uploads/2021/05/terkiniid_img_20210522_085917.jpg',
      'alamat' => 'JL. Citerbang No. 4',
      'nomor_hp' => '083164873456',
      'email' => 'harrypebrianti@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 8,
      'nama_depan' => 'Jaak',
      'nama_belakang' => 'Jan Krist',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1980-01-08',
      'foto_profil' => 'https://sis.binus.ac.id/wp-content/uploads/2022/05/Picture37.png',
      'foto_ktp' => 'https://sis.binus.ac.id/wp-content/uploads/2022/05/Picture37.png',
      'alamat' => 'JL. Specimen EST No. 345678',
      'nomor_hp' => '081308202334',
      'email' => 'jaakkristjan@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 8,
      'nama_depan' => 'Sobhatkhoms',
      'nama_belakang' => '',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1972-09-20',
      'foto_profil' => 'https://assets.pikiran-rakyat.com/crop/85x0:725x439/x/photo/2021/10/07/472467860.jpg',
      'foto_ktp' => 'https://assets.pikiran-rakyat.com/crop/85x0:725x439/x/photo/2021/10/07/472467860.jpg',
      'alamat' => 'Jl Daan Mogot 59, Sulawesi Utara',
      'nomor_hp' => '082736582923',
      'email' => 'sobhatkhoms@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 8,
      'nama_depan' => 'Boy',
      'nama_belakang' => 'William',
      'jenis_kelamin' => 'Laki-Laki',
      'tanggal_lahir' => '1993-04-19',
      'foto_profil' => 'https://pertamax7.com/wp-content/uploads/2017/04/Letak-CHIP-RFID-E-KTP-KTP-ELEKTRONIK-6.jpg',
      'foto_ktp' => 'https://pertamax7.com/wp-content/uploads/2017/04/Letak-CHIP-RFID-E-KTP-KTP-ELEKTRONIK-6.jpg',
      'alamat' => 'Jl Raya Cakung Cilincing Gud Inkopal, Dki Jakarta',
      'nomor_hp' => '083746582938',
      'email' => 'boywilliam@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);

    DB::table('user')->insert([
      'id_role' => 8,
      'nama_depan' => 'Wati',
      'nama_belakang' => 'Putri',
      'jenis_kelamin' => 'Perempuan',
      'tanggal_lahir' => '1997-01-01',
      'foto_profil' => 'https://demo.nodeflux.io/assets/images/analytics/ocr-ktp/example1.jpg',
      'foto_ktp' => 'https://demo.nodeflux.io/assets/images/analytics/ocr-ktp/example1.jpg',
      'alamat' => 'JLN. Mangga Harum No. 234',
      'nomor_hp' => '081451451451',
      'email' => 'watiputri@gmail.com',
      'password' => '$2a$12$zQZg6Gyy3JwojQ3o2mgJWOlaXJtTGUXn3aEyCdb.DPO/VleOJzwaS',
    ]);
  }
}
