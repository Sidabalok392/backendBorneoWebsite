<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Utils\HttpCode;
use App\Utils\Utils;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SparepartController extends Controller
{
  public function Create(Request $request)
  {
    $createSparepart = $request->all();
    $validation = Validator(
      $createSparepart,
      [
        'id_toko_sparepart' => [
          'required',
          'integer',
          'exists:toko_sparepart,id_toko_sparepart',
        ],
        'nama_sparepart' => [
          'required',
          'min:3',
          'max:20',
        ],
        'harga_sparepart' => [
          'required',
          'integer',
          'min:1000',
          'max:1000000000',
        ],
        'jumlah_unit' => [
          'required',
          'integer',
          'min:1',
          'max:50000',
        ],
        'foto_sparepart' => [
          'required',
          'image',
        ],
      ],
      [
        'id_toko_sparepart.required' => 'ID Toko Sparepart Tidak Boleh Kosong !',
        'id_toko_sparepart.integer' => 'ID Toko Sparepart Harus Berupa Angka !',
        'id_toko_sparepart.exists' => 'ID Toko Sparepart Tidak Ditemukan !',

        'nama_sparepart.required' => 'Nama Sparepart Tidak Boleh Kosong !',
        'nama_sparepart.min' => 'Panjang Nama Sparepart Minimal 3 Karakter !',
        'nama_sparepart.max' => 'Panjang Nama Sparepart Maksimal 20 Karakter !',

        'harga_sparepart.required' => 'Harga Sparepart Tidak Boleh Kosong !',
        'harga_sparepart.integer' => 'Harga Sparepart Harus Berupa Angka !',
        'harga_sparepart.min' => 'Harga Sparepart Minimal Rp. 1000 !',
        'harga_sparepart.max' => 'Harga Sparepart Maksimal Rp. 1000000000 !',

        'jumlah_unit.required' => 'Jumlah Unit Tidak Boleh Kosong !',
        'jumlah_unit.integer' => 'Jumlah Unit Harus Berupa Angka !',
        'jumlah_unit.min' => 'Jumlah Unit Minimal 1 Unit !',
        'jumlah_unit.max' => 'Jumlah Unit Maksimal 50000 Unit !',

        'foto_sparepart.required' => 'Foto Sparepart Tidak Boleh Kosong !',
        'foto_sparepart.image' => 'Foto Sparepart Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $sparepart = Sparepart::create($createSparepart);

      $foto_sparepart_name = $sparepart->id_toko_sparepart . '_' . $sparepart->id_sparepart . '_' . $sparepart->foto_sparepart->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_sparepart/' . $foto_sparepart_name;
      $sparepart->foto_sparepart->storeAs('public/foto_sparepart', $foto_sparepart_name);
      $sparepart->foto_sparepart = $path;

      $sparepart->kode_sparepart = Utils::PembagiKode($createSparepart['nama_sparepart'], $sparepart);
      $sparepart->save();
      $sparepart = Sparepart::Find($sparepart->id_sparepart);

      $response = array(
        'message' => 'Data Sparepart Baru Berhasil Dibuat !',
        'sparepart' => $sparepart,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Sparepart Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $sparepart = Sparepart::all();

    if (count($sparepart) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Sparepart !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Sparepart !',
        'sparepart' => $sparepart
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $sparepart_old = Sparepart::find($id);
    $sparepart_new = Sparepart::find($id);

    if (empty($sparepart_old)) {
      return response(
        ['message' => 'Data Sparepart Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateSparepart = $request->all();
    $validation = Validator(
      $updateSparepart,
      [
        'id_toko_sparepart' => [
          'nullable',
          'integer',
          'exists:toko_sparepart,id_toko_sparepart',
        ],
        'nama_sparepart' => [
          'nullable',
          'min:3',
          'max:20',
        ],
        'harga_sparepart' => [
          'nullable',
          'integer',
          'min:1000',
          'max:1000000000',
        ],
        'jumlah_unit' => [
          'nullable',
          'integer',
          'min:1',
          'max:50000',
        ],
        'foto_sparepart' => [
          'nullable',
          'image',
        ],
      ],
      [
        'id_toko_sparepart.integer' => 'ID Toko Sparepart Harus Berupa Angka !',
        'id_toko_sparepart.exists' => 'ID Toko Sparepart Tidak Ditemukan !',

        'nama_sparepart.min' => 'Panjang Nama Sparepart Minimal 3 Karakter !',
        'nama_sparepart.max' => 'Panjang Nama Sparepart Maksimal 20 Karakter !',

        'harga_sparepart.integer' => 'Harga Sparepart Harus Berupa Angka !',
        'harga_sparepart.min' => 'Harga Sparepart Minimal Rp. 1000 !',
        'harga_sparepart.max' => 'Harga Sparepart Maksimal Rp. 1000000000 !',

        'jumlah_unit.integer' => 'Jumlah Unit Harus Berupa Angka !',
        'jumlah_unit.min' => 'Jumlah Unit Minimal 1 Unit !',
        'jumlah_unit.max' => 'Jumlah Unit Maksimal 50000 Unit !',

        'foto_sparepart.image' => 'Foto Sparepart Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateSparepart['id_toko_sparepart'])) {
        $sparepart_new->id_toko_sparepart = $updateSparepart['id_toko_sparepart'];
      }

      if (!empty($updateSparepart['nama_sparepart'])) {
        $sparepart_new->nama_sparepart = $updateSparepart['nama_sparepart'];
        $sparepart_new->kode_sparepart = Utils::PembagiKode($sparepart_new->nama_sparepart, $sparepart_new);
      }

      if (!empty($updateSparepart['harga_sparepart'])) {
        $sparepart_new->harga_sparepart = $updateSparepart['harga_sparepart'];
      }

      if (!empty($updateSparepart['jumlah_unit'])) {
        $sparepart_new->jumlah_unit = $updateSparepart['jumlah_unit'];
      }

      if (!empty($updateSparepart['foto_sparepart'])) {
        $foto_sparepart_name = $sparepart_new->id_toko_sparepart . '_' . $sparepart_new->id_sparepart . '_' . $updateSparepart['foto_sparepart']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_sparepart/' . $foto_sparepart_name;
        $updateSparepart['foto_sparepart']->storeAs('public/foto_sparepart', $foto_sparepart_name);

        $sparepart_new->foto_sparepart = $path;
      }

      $sparepart_new->save();
      $sparepart_new = Sparepart::find($id);

      return response(
        [
          'message' => 'Data Sparepart Berhasil Diubah !',
          'sparepart_old' => $sparepart_old,
          'sparepart_new' => $sparepart_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Sparepart Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $sparepart_old = Sparepart::find($id);
    $sparepart_new = Sparepart::find($id);

    if (empty($sparepart_old)) {
      return response(
        ['message' => 'Data Sparepart Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    try {
      $foto_sparepart_path = URL::to('/') . '/storage/foto_sparepart/';
      $foto_sparepart_name = str_replace($foto_sparepart_path, '', $sparepart_old->foto_sparepart);
      Storage::delete('public/foto_sparepart/' . $foto_sparepart_name);

      $sparepart_new->delete();

      return response(
        [
          'message' => 'Data Sparepart Berhasil Dihapus !',
          'sparepart_old' => $sparepart_old
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Sparepart Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $sparepart = Sparepart::find($id);

    if (empty($sparepart)) {
      return response(
        ['message' => 'Data Sparepart Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Sparepart !',
        'sparepart' => $sparepart,
      ],
      HttpCode::$ok
    );
  }
}
