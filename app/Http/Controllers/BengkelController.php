<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\User;
use App\Utils\HttpCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BengkelController extends Controller
{
  public function Create(Request $request)
  {
    $createBengkel = $request->all();
    $validation = Validator(
      $createBengkel,
      [
        'id_user' => [
          'required',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($createBengkel['id_user']) ?
              (empty(User::find($createBengkel['id_user'])) ||
                User::find($createBengkel['id_user'])->id_role != 5) :
              false
          ),
        ],
        'nama_bengkel' => [
          'required',
          'min:3',
          'max:40',
        ],
        'alamat_bengkel' => [
          'required',
          'min:10',
          'max:200',
        ],
        'deskripsi_bengkel' => [
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
        'foto_bengkel' => [
          'required',
          'image',
        ],
        'lokasi_bengkel' => [
          'required',
        ],
      ],
      [
        'id_user.required' => 'ID User Tidak Boleh Kosong !',
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Bengkel !',

        'nama_bengkel.required' => 'Nama Bengkel Tidak Boleh Kosong !',
        'nama_bengkel.min' => 'Panjang Nama Bengkel Minimal 3 Karakter !',
        'nama_bengkel.max' => 'Panjang Nama Bengkel Maksimal 40 Karakter !',

        'alamat_bengkel.required' => 'Alamat Bengkel Tidak Boleh Kosong !',
        'alamat_bengkel.min' => 'Panjang Alamat Bengkel Minimal 10 Karakter !',
        'alamat_bengkel.max' => 'Panjang Alamat Bengkel Maksimal 200 Karakter !',

        'deskripsi_bengkel.required' => 'Deskripsi Bengkel Tidak Boleh Kosong !',
        'deskripsi_bengkel.min' => 'Panjang Deskripsi Bengkel Minimal 10 Karakter !',
        'deskripsi_bengkel.max' => 'Panjang Deskripsi Bengkel Maksimal 1000 Karakter !',

        'tanggal_berdiri.required' => 'Tanggal Berdiri Tidak Boleh Kosong !',
        'tanggal_berdiri.date_format' => 'Tanggal Berdiri Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_berdiri.date' => 'Tanggal Berdiri Harus Berupa Format Tanggal !',
        'tanggal_berdiri.before' => 'Tanggal Berdiri Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_berdiri.after' => 'Tanggal Berdiri Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_surat_izin.required' => 'Foto Surat Izin Tidak Boleh Kosong !',
        'foto_surat_izin.image' => 'Foto Surat Izin Harus Berupa Gambar !',

        'foto_bengkel.required' => 'Foto Bengkel Tidak Boleh Kosong !',
        'foto_bengkel.image' => 'Foto Bengkel Harus Berupa Gambar !',

        'lokasi_bengkel.required' => 'Lokasi Bengkel Tidak Boleh Kosong !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $bengkel = Bengkel::create($createBengkel);

      $foto_surat_izin_name = $bengkel->id_user . '_' . $bengkel->id_bengkel . '_' . $bengkel->foto_surat_izin->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_surat_izin/' . $foto_surat_izin_name;
      $bengkel->foto_surat_izin->storeAs('public/foto_surat_izin', $foto_surat_izin_name);
      $bengkel->foto_surat_izin = $path;
      $bengkel->save();

      $foto_bengkel_name = $bengkel->id_user . '_' . $bengkel->id_bengkel . '_' . $bengkel->foto_bengkel->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_bengkel/' . $foto_bengkel_name;
      $bengkel->foto_bengkel->storeAs('public/foto_bengkel', $foto_bengkel_name);
      $bengkel->foto_bengkel = $path;
      $bengkel->save();
      $bengkel = Bengkel::Find($bengkel->id_bengkel);

      $response = array(
        'message' => 'Data Bengkel Baru Berhasil Dibuat !',
        'bengkel' => $bengkel,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Bengkel Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $bengkel = Bengkel::all();

    if (count($bengkel) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Bengkel !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Bengkel !',
        'bengkel' => $bengkel
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $bengkel_old = Bengkel::find($id);
    $bengkel_new = Bengkel::find($id);

    if (empty($bengkel_old)) {
      return response(
        ['message' => 'Data Bengkel Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateBengkel = $request->all();
    $validation = Validator(
      $updateBengkel,
      [
        'id_user' => [
          'nullable',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($updateBengkel['id_user']) ?
              (empty(User::find($updateBengkel['id_user'])) ||
                User::find($updateBengkel['id_user'])->id_role != 5) :
              false
          ),
        ],
        'nama_bengkel' => [
          'nullable',
          'min:3',
          'max:40',
        ],
        'alamat_bengkel' => [
          'nullable',
          'min:10',
          'max:200',
        ],
        'deskripsi_bengkel' => [
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
        'foto_bengkel' => [
          'nullable',
          'image',
        ],
        'lokasi_bengkel' => [
          'nullable',
        ],
      ],
      [
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Bengkel !',

        'nama_bengkel.min' => 'Panjang Nama Bengkel Minimal 3 Karakter !',
        'nama_bengkel.max' => 'Panjang Nama Bengkel Maksimal 40 Karakter !',

        'alamat_bengkel.min' => 'Panjang Alamat Bengkel Minimal 10 Karakter !',
        'alamat_bengkel.max' => 'Panjang Alamat Bengkel Maksimal 200 Karakter !',

        'deskripsi_bengkel.min' => 'Panjang Deskripsi Bengkel Minimal 10 Karakter !',
        'deskripsi_bengkel.max' => 'Panjang Deskripsi Bengkel Maksimal 1000 Karakter !',

        'tanggal_berdiri.date_format' => 'Tanggal Berdiri Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_berdiri.date' => 'Tanggal Berdiri Harus Berupa Format Tanggal !',
        'tanggal_berdiri.before' => 'Tanggal Berdiri Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_berdiri.after' => 'Tanggal Berdiri Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_surat_izin.image' => 'Foto Surat Izin Harus Berupa Gambar !',

        'foto_bengkel.image' => 'Foto Bengkel Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateBengkel['id_user'])) {
        $bengkel_new->id_user = $updateBengkel['id_user'];
      }

      if (!empty($updateBengkel['nama_bengkel'])) {
        $bengkel_new->nama_bengkel = $updateBengkel['nama_bengkel'];
      }

      if (!empty($updateBengkel['alamat_bengkel'])) {
        $bengkel_new->alamat_bengkel = $updateBengkel['alamat_bengkel'];
      }

      if (!empty($updateBengkel['deskripsi_bengkel'])) {
        $bengkel_new->deskripsi_bengkel = $updateBengkel['deskripsi_bengkel'];
      }

      if (!empty($updateBengkel['tanggal_berdiri'])) {
        $bengkel_new->tanggal_berdiri = $updateBengkel['tanggal_berdiri'];
      }

      if (!empty($updateBengkel['foto_surat_izin'])) {
        $foto_surat_izin_name = $bengkel_new->id_user . '_' . $bengkel_new->id_bengkel . '_' . $updateBengkel['foto_surat_izin']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_surat_izin/' . $foto_surat_izin_name;
        $updateBengkel['foto_surat_izin']->storeAs('public/foto_surat_izin', $foto_surat_izin_name);

        $bengkel_new->foto_surat_izin = $path;
      }

      if (!empty($updateBengkel['foto_bengkel'])) {
        $foto_bengkel_name = $bengkel_new->id_user . '_' . $bengkel_new->id_bengkel . '_' . $updateBengkel['foto_bengkel']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_bengkel/' . $foto_bengkel_name;
        $updateBengkel['foto_bengkel']->storeAs('public/foto_bengkel', $foto_bengkel_name);

        $bengkel_new->foto_bengkel = $path;
      }

      if (!empty($updateBengkel['lokasi_bengkel'])) {
        $bengkel_new->lokasi_bengkel = $updateBengkel['lokasi_bengkel'];
      }

      $bengkel_new->save();
      $bengkel_new = Bengkel::Find($id);

      return response(
        [
          'message' => 'Data Bengkel Berhasil Diubah !',
          'bengkel_old' => $bengkel_old,
          'bengkel_new' => $bengkel_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Bengkel Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $bengkel_old = Bengkel::find($id);
    $bengkel_new = Bengkel::find($id);

    if (empty($bengkel_old)) {
      return response(
        ['message' => 'Data Bengkel Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    try {
      $foto_surat_izin_path = URL::to('/') . '/storage/foto_surat_izin/';
      $foto_surat_izin_name = str_replace($foto_surat_izin_path, '', $bengkel_old->foto_surat_izin);
      Storage::delete('public/foto_surat_izin/' . $foto_surat_izin_name);

      $foto_bengkel_path = URL::to('/') . '/storage/foto_bengkel/';
      $foto_bengkel_name = str_replace($foto_bengkel_path, '', $bengkel_old->foto_bengkel);
      Storage::delete('public/foto_bengkel/' . $foto_bengkel_name);

      $bengkel_new->delete();

      return response(
        [
          'message' => 'Data Bengkel Berhasil Dihapus !',
          'bengkel_old' => $bengkel_old
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Bengkel Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $bengkel = Bengkel::find($id);

    if (empty($bengkel)) {
      return response(
        ['message' => 'Data Bengkel Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Bengkel !',
        'bengkel' => $bengkel,
      ],
      HttpCode::$ok
    );
  }
}
