<?php

namespace App\Http\Controllers;

use App\Models\TokoSparepart;
use App\Models\User;
use App\Utils\HttpCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TokoSparepartController extends Controller
{
  public function Create(Request $request)
  {
    $createTokoSparepart = $request->all();
    $validation = Validator(
      $createTokoSparepart,
      [
        'id_user' => [
          'required',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($createTokoSparepart['id_user']) ?
              (empty(User::find($createTokoSparepart['id_user'])) ||
                User::find($createTokoSparepart['id_user'])->id_role != 8) :
              false
          ),
        ],
        'nama_toko_sparepart' => [
          'required',
          'min:3',
          'max:40',
        ],
        'alamat_toko_sparepart' => [
          'required',
          'min:10',
          'max:200',
        ],
        'deskripsi_toko_sparepart' => [
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
        'foto_toko_sparepart' => [
          'required',
          'image',
        ],
        'lokasi_toko_sparepart' => [
          'required',
        ],
      ],
      [
        'id_user.required' => 'ID User Tidak Boleh Kosong !',
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Toko Sparepart !',

        'nama_toko_sparepart.required' => 'Nama Toko Sparepart Tidak Boleh Kosong !',
        'nama_toko_sparepart.min' => 'Panjang Nama Toko Sparepart Minimal 3 Karakter !',
        'nama_toko_sparepart.max' => 'Panjang Nama Toko Sparepart Maksimal 40 Karakter !',

        'alamat_toko_sparepart.required' => 'Alamat Toko Sparepart Tidak Boleh Kosong !',
        'alamat_toko_sparepart.min' => 'Panjang Alamat Toko Sparepart Minimal 10 Karakter !',
        'alamat_toko_sparepart.max' => 'Panjang Alamat Toko Sparepart Maksimal 200 Karakter !',

        'deskripsi_toko_sparepart.required' => 'Deskripsi Toko Sparepart Tidak Boleh Kosong !',
        'deskripsi_toko_sparepart.min' => 'Panjang Deskripsi Toko Sparepart Minimal 10 Karakter !',
        'deskripsi_toko_sparepart.max' => 'Panjang Deskripsi Toko Sparepart Maksimal 1000 Karakter !',

        'tanggal_berdiri.required' => 'Tanggal Berdiri Tidak Boleh Kosong !',
        'tanggal_berdiri.date_format' => 'Tanggal Berdiri Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_berdiri.date' => 'Tanggal Berdiri Harus Berupa Format Tanggal !',
        'tanggal_berdiri.before' => 'Tanggal Berdiri Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_berdiri.after' => 'Tanggal Berdiri Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_surat_izin.required' => 'Foto Surat Izin Tidak Boleh Kosong !',
        'foto_surat_izin.image' => 'Foto Surat Izin Harus Berupa Gambar !',

        'foto_toko_sparepart.required' => 'Foto Toko Sparepart Tidak Boleh Kosong !',
        'foto_toko_sparepart.image' => 'Foto Toko Sparepart Harus Berupa Gambar !',

        'lokasi_toko_sparepart.required' => 'Lokasi Toko Sparepart Tidak Boleh Kosong !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $toko_sparepart = TokoSparepart::create($createTokoSparepart);

      $foto_surat_izin_name = $toko_sparepart->id_user . '_' . $toko_sparepart->id_toko_sparepart . '_' . $toko_sparepart->foto_surat_izin->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_surat_izin/' . $foto_surat_izin_name;
      $toko_sparepart->foto_surat_izin->storeAs('public/foto_surat_izin', $foto_surat_izin_name);
      $toko_sparepart->foto_surat_izin = $path;
      $toko_sparepart->save();

      $foto_toko_sparepart_name = $toko_sparepart->id_user . '_' . $toko_sparepart->id_toko_sparepart . '_' . $toko_sparepart->foto_toko_sparepart->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_toko_sparepart/' . $foto_toko_sparepart_name;
      $toko_sparepart->foto_toko_sparepart->storeAs('public/foto_toko_sparepart', $foto_toko_sparepart_name);
      $toko_sparepart->foto_toko_sparepart = $path;
      $toko_sparepart->save();
      $toko_sparepart = TokoSparepart::Find($toko_sparepart->id_toko_sparepart);

      $response = array(
        'message' => 'Data Toko Sparepart Baru Berhasil Dibuat !',
        'toko_sparepart' => $toko_sparepart,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Toko Sparepart Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $toko_sparepart = TokoSparepart::all();

    if (count($toko_sparepart) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Toko Sparepart !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Menampilkan Semua Data Toko Sparepart !',
      'toko_sparepart' => $toko_sparepart,
    );

    foreach ($toko_sparepart as $toko_sparepart) {
      $this->ShowAllPair($toko_sparepart);
    }

    return response(
      $response,
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $toko_sparepart_old = TokoSparepart::find($id);
    $toko_sparepart_new = TokoSparepart::find($id);

    if (empty($toko_sparepart_old)) {
      return response(
        ['message' => 'Data Toko Sparepart Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateTokoSparepart = $request->all();
    $validation = Validator(
      $updateTokoSparepart,
      [
        'id_user' => [
          'nullable',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($updateTokoSparepart['id_user']) ?
              (empty(User::find($updateTokoSparepart['id_user'])) ||
                User::find($updateTokoSparepart['id_user'])->id_role != 8) :
              false
          ),
        ],
        'nama_toko_sparepart' => [
          'nullable',
          'min:3',
          'max:40',
        ],
        'alamat_toko_sparepart' => [
          'nullable',
          'min:10',
          'max:200',
        ],
        'deskripsi_toko_sparepart' => [
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
        'foto_toko_sparepart' => [
          'nullable',
          'image',
        ],
        'lokasi_toko_sparepart' => [
          'nullable',
        ],
      ],
      [
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Toko Sparepart !',

        'nama_toko_sparepart.min' => 'Panjang Nama Toko Sparepart Minimal 3 Karakter !',
        'nama_toko_sparepart.max' => 'Panjang Nama Toko Sparepart Maksimal 40 Karakter !',

        'alamat_toko_sparepart.min' => 'Panjang Alamat Toko Sparepart Minimal 10 Karakter !',
        'alamat_toko_sparepart.max' => 'Panjang Alamat Toko Sparepart Maksimal 200 Karakter !',

        'deskripsi_toko_sparepart.min' => 'Panjang Deskripsi Toko Sparepart Minimal 10 Karakter !',
        'deskripsi_toko_sparepart.max' => 'Panjang Deskripsi Toko Sparepart Maksimal 1000 Karakter !',

        'tanggal_berdiri.date_format' => 'Tanggal Berdiri Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_berdiri.date' => 'Tanggal Berdiri Harus Berupa Format Tanggal !',
        'tanggal_berdiri.before' => 'Tanggal Berdiri Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_berdiri.after' => 'Tanggal Berdiri Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_surat_izin.image' => 'Foto Surat Izin Harus Berupa Gambar !',

        'foto_toko_sparepart.image' => 'Foto Toko Sparepart Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateTokoSparepart['id_user'])) {
        $toko_sparepart_new->id_user = $updateTokoSparepart['id_user'];
      }

      if (!empty($updateTokoSparepart['nama_toko_sparepart'])) {
        $toko_sparepart_new->nama_toko_sparepart = $updateTokoSparepart['nama_toko_sparepart'];
      }

      if (!empty($updateTokoSparepart['alamat_toko_sparepart'])) {
        $toko_sparepart_new->alamat_toko_sparepart = $updateTokoSparepart['alamat_toko_sparepart'];
      }

      if (!empty($updateTokoSparepart['deskripsi_toko_sparepart'])) {
        $toko_sparepart_new->deskripsi_toko_sparepart = $updateTokoSparepart['deskripsi_toko_sparepart'];
      }

      if (!empty($updateTokoSparepart['tanggal_berdiri'])) {
        $toko_sparepart_new->tanggal_berdiri = $updateTokoSparepart['tanggal_berdiri'];
      }

      if (!empty($updateTokoSparepart['foto_surat_izin'])) {
        $foto_surat_izin_name = $toko_sparepart_new->id_user . '_' . $toko_sparepart_new->id_toko_sparepart . '_' . $updateTokoSparepart['foto_surat_izin']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_surat_izin/' . $foto_surat_izin_name;
        $updateTokoSparepart['foto_surat_izin']->storeAs('public/foto_surat_izin', $foto_surat_izin_name);

        $toko_sparepart_new->foto_surat_izin = $path;
      }

      if (!empty($updateTokoSparepart['foto_toko_sparepart'])) {
        $foto_toko_sparepart_name = $toko_sparepart_new->id_user . '_' . $toko_sparepart_new->id_toko_sparepart . '_' . $updateTokoSparepart['foto_toko_sparepart']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_toko_sparepart/' . $foto_toko_sparepart_name;
        $updateTokoSparepart['foto_toko_sparepart']->storeAs('public/foto_toko_sparepart', $foto_toko_sparepart_name);

        $toko_sparepart_new->foto_toko_sparepart = $path;
      }

      if (!empty($updateTokoSparepart['lokasi_toko_sparepart'])) {
        $toko_sparepart_new->lokasi_toko_sparepart = $updateTokoSparepart['lokasi_toko_sparepart'];
      }

      $toko_sparepart_new->save();
      $toko_sparepart_new = TokoSparepart::find($id);

      return response(
        [
          'message' => 'Data Toko Sparepart Berhasil Diubah !',
          'toko_sparepart_old' => $toko_sparepart_old,
          'toko_sparepart_new' => $toko_sparepart_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Toko Sparepart Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $toko_sparepart_old = TokoSparepart::find($id);
    $toko_sparepart_new = TokoSparepart::find($id);

    if (empty($toko_sparepart_old)) {
      return response(
        ['message' => 'Data Toko Sparepart Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Data Toko Sparepart Berhasil Dihapus !',
      'toko_sparepart_old' => $toko_sparepart_old,
    );

    $this->ShowAllPair($toko_sparepart_old);

    try {
      $foto_surat_izin_path = URL::to('/') . '/storage/foto_surat_izin/';
      $foto_surat_izin_name = str_replace($foto_surat_izin_path, '', $toko_sparepart_old->foto_surat_izin);
      Storage::delete('public/foto_surat_izin/' . $foto_surat_izin_name);

      $foto_toko_sparepart_path = URL::to('/') . '/storage/foto_toko_sparepart/';
      $foto_toko_sparepart_name = str_replace($foto_toko_sparepart_path, '', $toko_sparepart_old->foto_toko_sparepart);
      Storage::delete('public/foto_toko_sparepart/' . $foto_toko_sparepart_name);

      DB::table('sparepart')
        ->where('id_toko_sparepart', '=', $toko_sparepart_old->id_toko_sparepart)
        ->delete();

      $toko_sparepart_new->delete();

      return response(
        $response,
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Toko Sparepart Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $toko_sparepart = TokoSparepart::find($id);

    if (empty($toko_sparepart)) {
      return response(
        ['message' => 'Data Toko Sparepart Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Menampilkan Data Toko Sparepart !',
      'toko_sparepart' => $toko_sparepart,
    );

    $this->ShowAllPair($toko_sparepart);

    return response(
      $response,
      HttpCode::$ok
    );
  }

  private function ShowAllPair($toko_sparepart)
  {
    $sparepart = json_decode(DB::table('sparepart')
      ->where('id_toko_sparepart', '=', $toko_sparepart->id_toko_sparepart)
      ->get(), true);

    $toko_sparepart['sparepart'] = $sparepart;

    return $toko_sparepart;
  }
}
