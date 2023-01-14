<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Utils\HttpCode;
use Exception;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
  public function Create(Request $request)
  {
    $createUlasan = $request->all();
    $validation = Validator(
      $createUlasan,
      [
        'id_user' => [
          'required',
          'integer',
          'exists:user,id_user',
        ],
        'ulasan' => [
          'required',
          'min:5',
          'max:65000',
        ],
        'rating' => [
          'required',
          'integer',
          'min:0',
          'max:5',
        ],
      ],
      [
        'id_user.required' => 'ID User Tidak Boleh Kosong !',
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',

        'ulasan.required' => 'Ulasan Tidak Boleh Kosong !',
        'ulasan.min' => 'Panjang Ulasan Minimal 5 Karakter !',
        'ulasan.max' => 'Panjang Ulasan Maksimal 65000 Karakter !',

        'rating.required' => 'Rating Tidak Boleh Kosong !',
        'rating.integer' => 'Rating Harus Berupa Angka !',
        'rating.min' => 'Rating Minimal 0 !',
        'rating.max' => 'Rating Maksimal 5 !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $ulasan = Ulasan::create($createUlasan);
      $ulasan = Ulasan::Find($ulasan->id_ulasan);

      $response = array(
        'message' => 'Data Ulasan Baru Berhasil Dibuat !',
        'ulasan' => $ulasan,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Ulasan Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $ulasan = Ulasan::all();

    if (count($ulasan) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Ulasan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Ulasan !',
        'ulasan' => $ulasan
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $ulasan_old = Ulasan::find($id);
    $ulasan_new = Ulasan::find($id);

    if (empty($ulasan_old)) {
      return response(
        ['message' => 'Data Ulasan Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateUlasan = $request->all();
    $validation = Validator(
      $updateUlasan,
      [
        'id_user' => [
          'nullable',
          'integer',
          'exists:user,id_user',
        ],
        'ulasan' => [
          'nullable',
          'min:5',
          'max:65000',
        ],
        'rating' => [
          'nullable',
          'integer',
          'min:0',
          'max:5',
        ],
      ],
      [
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',

        'ulasan.min' => 'Panjang Ulasan Minimal 5 Karakter !',
        'ulasan.max' => 'Panjang Ulasan Maksimal 65000 Karakter !',

        'rating.integer' => 'Rating Harus Berupa Angka !',
        'rating.min' => 'Rating Minimal 0 !',
        'rating.max' => 'Rating Maksimal 5 !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateUlasan['id_user'])) {
        $ulasan_new->id_user = $updateUlasan['id_user'];
      }

      if (!empty($updateUlasan['ulasan'])) {
        $ulasan_new->ulasan = $updateUlasan['ulasan'];
      }

      if (!empty($updateUlasan['rating'])) {
        $ulasan_new->rating = $updateUlasan['rating'];
      }

      $ulasan_new->save();
      $ulasan_new = Ulasan::find($id);

      return response(
        [
          'message' => 'Data Ulasan Berhasil Diubah !',
          'ulasan_old' => $ulasan_old,
          'ulasan_new' => $ulasan_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Ulasan Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $ulasan_old = Ulasan::find($id);
    $ulasan_new = Ulasan::find($id);

    if (empty($ulasan_old)) {
      return response(
        ['message' => 'Data Ulasan Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    try {
      $ulasan_new->delete();

      return response(
        [
          'message' => 'Data Ulasan Berhasil Dihapus !',
          'ulasan_old' => $ulasan_old
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Ulasan Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $ulasan = Ulasan::find($id);

    if (empty($ulasan)) {
      return response(
        ['message' => 'Data Ulasan Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Ulasan !',
        'ulasan' => $ulasan,
      ],
      HttpCode::$ok
    );
  }
}
