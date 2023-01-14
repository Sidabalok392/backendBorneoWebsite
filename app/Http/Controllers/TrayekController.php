<?php

namespace App\Http\Controllers;

use App\Models\Trayek;
use App\Utils\HttpCode;
use Exception;
use Illuminate\Http\Request;

class TrayekController extends Controller
{
  public function Create(Request $request)
  {
    $createTrayek = $request->all();
    $validation = Validator(
      $createTrayek,
      [
        'id_armada' => [
          'required',
          'integer',
          'exists:armada,id_armada',
        ],
        'jarak_tempuh' => [
          'required',
          'numeric',
          'min:1',
          'max:10000',
        ],
        'waktu_tempuh' => [
          'required',
          'numeric',
          'min:1',
          'max:8640',
        ],
        'jenis_muatan' => [
          'required',
          'min:3',
          'max:50',
        ],
        'konsumsi_bahan_bakar' => [
          'required',
          'numeric',
          'min:1',
          'max:10000',
        ],
        'uang_perjalanan' => [
          'required',
          'integer',
          'min:10000',
          'max:1000000000',
        ],
      ],
      [
        'id_armada.required' => 'ID Armada Tidak Boleh Kosong !',
        'id_armada.integer' => 'ID Armada Harus Berupa Angka !',
        'id_armada.exists' => 'ID Armada Tidak Ditemukan !',

        'jarak_tempuh.required' => 'Jarak Tempuh Tidak Boleh Kosong !',
        'jarak_tempuh.numeric' => 'Jarak Tempuh Harus Berupa Angka !',
        'jarak_tempuh.min' => 'Jarak Tempuh Minimal 1 Km !',
        'jarak_tempuh.max' => 'Jarak Tempuh Maksimal 10000 Km !',

        'waktu_tempuh.required' => 'Waktu Tempuh Tidak Boleh Kosong !',
        'waktu_tempuh.numeric' => 'Waktu Tempuh Harus Berupa Angka !',
        'waktu_tempuh.min' => 'Waktu Tempuh Minimal 1 Jam !',
        'waktu_tempuh.max' => 'Waktu Tempuh Maksimal 8640 Jam !',

        'jenis_muatan.required' => 'Jenis Muatan Tidak Boleh Kosong !',
        'jenis_muatan.min' => 'Panjang Jenis Muatan Minimal 3 Karakter !',
        'jenis_muatan.max' => 'Panjang Jenis Muatan Maksimal 40 Karakter !',

        'konsumsi_bahan_bakar.required' => 'Konsumsi Bahan Bakar Tidak Boleh Kosong !',
        'konsumsi_bahan_bakar.numeric' => 'Konsumsi Bahan Bakar Harus Berupa Angka !',
        'konsumsi_bahan_bakar.min' => 'Konsumsi Bahan Bakar Minimal 1 Liter !',
        'konsumsi_bahan_bakar.max' => 'Konsumsi Bahan Bakar Maksimal 10000 Liter !',

        'uang_perjalanan.required' => 'Uang Perjalanan Tidak Boleh Kosong !',
        'uang_perjalanan.integer' => 'Uang Perjalanan Harus Berupa Angka !',
        'uang_perjalanan.min' => 'Uang Perjalanan Minimal Rp.10000 !',
        'uang_perjalanan.max' => 'Uang Perjalanan Maksimal Rp.1000000000 !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $trayek = Trayek::create($createTrayek);
      $trayek = Trayek::Find($trayek->id_trayek);

      $response = array(
        'message' => 'Data Trayek Baru Berhasil Dibuat !',
        'trayek' => $trayek,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Trayek Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $trayek = Trayek::all();

    if (count($trayek) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Trayek !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Trayek !',
        'trayek' => $trayek
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $trayek_old = Trayek::find($id);
    $trayek_new = Trayek::find($id);

    if (empty($trayek_old)) {
      return response(
        ['message' => 'Data Trayek Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateTrayek = $request->all();
    $validation = Validator(
      $updateTrayek,
      [
        'id_armada' => [
          'nullable',
          'integer',
          'exists:armada,id_armada',
        ],
        'jarak_tempuh' => [
          'nullable',
          'numeric',
          'min:1',
          'max:10000',
        ],
        'waktu_tempuh' => [
          'nullable',
          'numeric',
          'min:1',
          'max:8640',
        ],
        'jenis_muatan' => [
          'nullable',
          'min:3',
          'max:50',
        ],
        'konsumsi_bahan_bakar' => [
          'nullable',
          'numeric',
          'min:1',
          'max:10000',
        ],
        'uang_perjalanan' => [
          'nullable',
          'integer',
          'min:10000',
          'max:1000000000',
        ],
      ],
      [
        'id_armada.integer' => 'ID Armada Harus Berupa Angka !',
        'id_armada.exists' => 'ID Armada Tidak Ditemukan !',

        'jarak_tempuh.numeric' => 'Jarak Tempuh Harus Berupa Angka !',
        'jarak_tempuh.min' => 'Jarak Tempuh Minimal 1 Km !',
        'jarak_tempuh.max' => 'Jarak Tempuh Maksimal 10000 Km !',

        'waktu_tempuh.numeric' => 'Waktu Tempuh Harus Berupa Angka !',
        'waktu_tempuh.min' => 'Waktu Tempuh Minimal 1 Jam !',
        'waktu_tempuh.max' => 'Waktu Tempuh Maksimal 8640 Jam !',

        'jenis_muatan.min' => 'Panjang Jenis Muatan Minimal 3 Karakter !',
        'jenis_muatan.max' => 'Panjang Jenis Muatan Maksimal 40 Karakter !',

        'konsumsi_bahan_bakar.numeric' => 'Konsumsi Bahan Bakar Harus Berupa Angka !',
        'konsumsi_bahan_bakar.min' => 'Konsumsi Bahan Bakar Minimal 1 Liter !',
        'konsumsi_bahan_bakar.max' => 'Konsumsi Bahan Bakar Maksimal 10000 Liter !',

        'uang_perjalanan.integer' => 'Uang Perjalanan Harus Berupa Angka !',
        'uang_perjalanan.min' => 'Uang Perjalanan Minimal Rp.10000 !',
        'uang_perjalanan.max' => 'Uang Perjalanan Maksimal Rp.1000000000 !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateTrayek['id_armada'])) {
        $trayek_new->id_armada = $updateTrayek['id_armada'];
      }

      if (!empty($updateTrayek['jarak_tempuh'])) {
        $trayek_new->jarak_tempuh = $updateTrayek['jarak_tempuh'];
      }

      if (!empty($updateTrayek['waktu_tempuh'])) {
        $trayek_new->waktu_tempuh = $updateTrayek['waktu_tempuh'];
      }

      if (!empty($updateTrayek['jenis_muatan'])) {
        $trayek_new->jenis_muatan = $updateTrayek['jenis_muatan'];
      }

      if (!empty($updateTrayek['konsumsi_bahan_bakar'])) {
        $trayek_new->konsumsi_bahan_bakar = $updateTrayek['konsumsi_bahan_bakar'];
      }

      if (!empty($updateTrayek['uang_perjalanan'])) {
        $trayek_new->uang_perjalanan = $updateTrayek['uang_perjalanan'];
      }

      $trayek_new->save();
      $trayek_new = Trayek::Find($id);

      return response(
        [
          'message' => 'Data Trayek Berhasil Diubah !',
          'trayek_old' => $trayek_old,
          'trayek_new' => $trayek_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Trayek Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $trayek_old = Trayek::find($id);
    $trayek_new = Trayek::find($id);

    if (empty($trayek_old)) {
      return response(
        ['message' => 'Data Trayek Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    try {
      $trayek_new->delete();

      return response(
        [
          'message' => 'Data Trayek Berhasil Dihapus !',
          'trayek_old' => $trayek_old
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Trayek Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $trayek = Trayek::find($id);

    if (empty($trayek)) {
      return response(
        ['message' => 'Data Trayek Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Trayek !',
        'trayek' => $trayek,
      ],
      HttpCode::$ok
    );
  }
}
