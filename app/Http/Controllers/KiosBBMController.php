<?php

namespace App\Http\Controllers;

use App\Models\KiosBBM;
use App\Models\User;
use App\Utils\HttpCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KiosBBMController extends Controller
{
  public function Create(Request $request)
  {
    $createKiosBBM = $request->all();
    $validation = Validator(
      $createKiosBBM,
      [
        'id_user' => [
          'required',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($createKiosBBM['id_user']) ?
              (empty(User::find($createKiosBBM['id_user'])) ||
                User::find($createKiosBBM['id_user'])->id_role != 6) :
              false
          ),
        ],
        'nama_kios_bbm' => [
          'required',
          'min:3',
          'max:40',
        ],
        'alamat_kios_bbm' => [
          'required',
          'min:10',
          'max:200',
        ],
        'deskripsi_kios_bbm' => [
          'required',
          'min:10',
          'max:1000',
        ],
        'tanggal_berdiri' => [
          'required',
          'date_format:Y-m-d',
          'date',
          'before:' . Carbon::now(),
          'after:' . strtotime(Carbon::now() . ' -70 year'),
        ],
        'foto_surat_izin' => [
          'required',
          'image',
        ],
        'foto_kios_bbm' => [
          'required',
          'image',
        ],
        'lokasi_kios_bbm' => [
          'required',
        ],
      ],
      [
        'id_user.required' => 'ID User Tidak Boleh Kosong !',
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Kios BBM !',

        'nama_kios_bbm.required' => 'Nama Kios BBM Tidak Boleh Kosong !',
        'nama_kios_bbm.min' => 'Panjang Nama Kios BBM Minimal 3 Karakter !',
        'nama_kios_bbm.max' => 'Panjang Nama Kios BBM Maksimal 40 Karakter !',

        'alamat_kios_bbm.required' => 'Alamat Kios BBM Tidak Boleh Kosong !',
        'alamat_kios_bbm.min' => 'Panjang Alamat Kios BBM Minimal 10 Karakter !',
        'alamat_kios_bbm.max' => 'Panjang Alamat Kios BBM Maksimal 200 Karakter !',

        'deskripsi_kios_bbm.required' => 'Deskripsi Kios BBM Tidak Boleh Kosong !',
        'deskripsi_kios_bbm.min' => 'Panjang Deskripsi Kios BBM Minimal 10 Karakter !',
        'deskripsi_kios_bbm.max' => 'Panjang Deskripsi Kios BBM Maksimal 1000 Karakter !',

        'tanggal_berdiri.required' => 'Tanggal Berdiri Tidak Boleh Kosong !',
        'tanggal_berdiri.date_format' => 'Tanggal Berdiri Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_berdiri.date' => 'Tanggal Berdiri Harus Berupa Format Tanggal !',
        'tanggal_berdiri.before' => 'Tanggal Berdiri Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_berdiri.after' => 'Tanggal Berdiri Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_surat_izin.required' => 'Foto Surat Izin Tidak Boleh Kosong !',
        'foto_surat_izin.image' => 'Foto Surat Izin Harus Berupa Gambar !',

        'foto_kios_bbm.required' => 'Foto Kios BBM Tidak Boleh Kosong !',
        'foto_kios_bbm.image' => 'Foto Kios BBM Harus Berupa Gambar !',

        'lokasi_kios_bbm.required' => 'Lokasi Kios BBM Tidak Boleh Kosong !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $kios_bbm = KiosBBM::create($createKiosBBM);

      $foto_surat_izin_name = $kios_bbm->id_user . '_' . $kios_bbm->id_kios_bbm . '_' . $kios_bbm->foto_surat_izin->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_surat_izin/' . $foto_surat_izin_name;
      $kios_bbm->foto_surat_izin->storeAs('public/foto_surat_izin', $foto_surat_izin_name);
      $kios_bbm->foto_surat_izin = $path;
      $kios_bbm->save();

      $foto_kios_bbm_name = $kios_bbm->id_user . '_' . $kios_bbm->id_kios_bbm . '_' . $kios_bbm->foto_kios_bbm->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_kios_bbm/' . $foto_kios_bbm_name;
      $kios_bbm->foto_kios_bbm->storeAs('public/foto_kios_bbm', $foto_kios_bbm_name);
      $kios_bbm->foto_kios_bbm = $path;
      $kios_bbm->save();
      $kios_bbm = KiosBBM::Find($kios_bbm->id_kios_bbm);

      $response = array(
        'message' => 'Data Kios BBM Baru Berhasil Dibuat !',
        'kios_bbm' => $kios_bbm,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Kios BBM Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $kios_bbm = KiosBBM::all();

    if (count($kios_bbm) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Kios BBM !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Kios BBM !',
        'kios_bbm' => $kios_bbm
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $kios_bbm_old = KiosBBM::find($id);
    $kios_bbm_new = KiosBBM::find($id);

    if (empty($kios_bbm_old)) {
      return response(
        ['message' => 'Data Kios BBM Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateKiosBBM = $request->all();
    $validation = Validator(
      $updateKiosBBM,
      [
        'id_user' => [
          'nullable',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($updateKiosBBM['id_user']) ?
              (empty(User::find($updateKiosBBM['id_user'])) ||
                User::find($updateKiosBBM['id_user'])->id_role != 6) :
              false
          ),
        ],
        'nama_kios_bbm' => [
          'nullable',
          'min:3',
          'max:40',
        ],
        'alamat_kios_bbm' => [
          'nullable',
          'min:10',
          'max:200',
        ],
        'deskripsi_kios_bbm' => [
          'nullable',
          'min:10',
          'max:1000',
        ],
        'tanggal_berdiri' => [
          'nullable',
          'date_format:Y-m-d',
          'date',
          'before:' . Carbon::now(),
          'after:' . strtotime(Carbon::now() . ' -70 year'),
        ],
        'foto_surat_izin' => [
          'nullable',
          'image',
        ],
        'foto_kios_bbm' => [
          'nullable',
          'image',
        ],
        'lokasi_kios_bbm' => [
          'nullable',
        ],
      ],
      [
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Kios BBM !',

        'nama_kios_bbm.min' => 'Panjang Nama Kios BBM Minimal 3 Karakter !',
        'nama_kios_bbm.max' => 'Panjang Nama Kios BBM Maksimal 40 Karakter !',

        'alamat_kios_bbm.min' => 'Panjang Alamat Kios BBM Minimal 10 Karakter !',
        'alamat_kios_bbm.max' => 'Panjang Alamat Kios BBM Maksimal 200 Karakter !',

        'deskripsi_kios_bbm.min' => 'Panjang Deskripsi Kios BBM Minimal 10 Karakter !',
        'deskripsi_kios_bbm.max' => 'Panjang Deskripsi Kios BBM Maksimal 1000 Karakter !',

        'tanggal_berdiri.date_format' => 'Tanggal Berdiri Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_berdiri.date' => 'Tanggal Berdiri Harus Berupa Format Tanggal !',
        'tanggal_berdiri.before' => 'Tanggal Berdiri Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_berdiri.after' => 'Tanggal Berdiri Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_surat_izin.image' => 'Foto Surat Izin Harus Berupa Gambar !',

        'foto_kios_bbm.image' => 'Foto Kios BBM Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateKiosBBM['id_user'])) {
        $kios_bbm_new->id_user = $updateKiosBBM['id_user'];
      }

      if (!empty($updateKiosBBM['nama_kios_bbm'])) {
        $kios_bbm_new->nama_kios_bbm = $updateKiosBBM['nama_kios_bbm'];
      }

      if (!empty($updateKiosBBM['alamat_kios_bbm'])) {
        $kios_bbm_new->alamat_kios_bbm = $updateKiosBBM['alamat_kios_bbm'];
      }

      if (!empty($updateKiosBBM['deskripsi_kios_bbm'])) {
        $kios_bbm_new->deskripsi_kios_bbm = $updateKiosBBM['deskripsi_kios_bbm'];
      }

      if (!empty($updateKiosBBM['tanggal_berdiri'])) {
        $kios_bbm_new->tanggal_berdiri = $updateKiosBBM['tanggal_berdiri'];
      }

      if (!empty($updateKiosBBM['foto_surat_izin'])) {
        $foto_surat_izin_name = $kios_bbm_new->id_user . '_' . $kios_bbm_new->id_kios_bbm . '_' . $updateKiosBBM['foto_surat_izin']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_surat_izin/' . $foto_surat_izin_name;
        $updateKiosBBM['foto_surat_izin']->storeAs('public/foto_surat_izin', $foto_surat_izin_name);

        $kios_bbm_new->foto_surat_izin = $path;
      }

      if (!empty($updateKiosBBM['foto_kios_bbm'])) {
        $foto_kios_bbm_name = $kios_bbm_new->id_user . '_' . $kios_bbm_new->id_kios_bbm . '_' . $updateKiosBBM['foto_kios_bbm']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_kios_bbm/' . $foto_kios_bbm_name;
        $updateKiosBBM['foto_kios_bbm']->storeAs('public/foto_kios_bbm', $foto_kios_bbm_name);

        $kios_bbm_new->foto_kios_bbm = $path;
      }

      if (!empty($updateKiosBBM['lokasi_kios_bbm'])) {
        $kios_bbm_new->lokasi_kios_bbm = $updateKiosBBM['lokasi_kios_bbm'];
      }

      $kios_bbm_new->save();
      $kios_bbm_new = KiosBBM::Find($id);

      return response(
        [
          'message' => 'Data Kios BBM Berhasil Diubah !',
          'kios_bbm_old' => $kios_bbm_old,
          'kios_bbm_new' => $kios_bbm_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Kios BBM Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $kios_bbm_old = KiosBBM::find($id);
    $kios_bbm_new = KiosBBM::find($id);

    if (empty($kios_bbm_old)) {
      return response(
        ['message' => 'Data Kios BBM Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    try {
      $foto_surat_izin_path = URL::to('/') . '/storage/foto_surat_izin/';
      $foto_surat_izin_name = str_replace($foto_surat_izin_path, '', $kios_bbm_old->foto_surat_izin);
      Storage::delete('public/foto_surat_izin/' . $foto_surat_izin_name);

      $foto_kios_bbm_path = URL::to('/') . '/storage/foto_kios_bbm/';
      $foto_kios_bbm_name = str_replace($foto_kios_bbm_path, '', $kios_bbm_old->foto_kios_bbm);
      Storage::delete('public/foto_kios_bbm/' . $foto_kios_bbm_name);

      $kios_bbm_new->delete();

      return response(
        [
          'message' => 'Data Kios BBM Berhasil Dihapus !',
          'kios_bbm_old' => $kios_bbm_old
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Kios BBM Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $kios_bbm = KiosBBM::find($id);

    if (empty($kios_bbm)) {
      return response(
        ['message' => 'Data Kios BBM Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Kios BBM !',
        'kios_bbm' => $kios_bbm,
      ],
      HttpCode::$ok
    );
  }
}
