<?php

namespace App\Http\Controllers;

use App\Models\JualBeli;
use App\Models\User;
use App\Utils\HttpCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class JualBeliController extends Controller
{
  public function Create(Request $request)
  {
    $createJualBeli = $request->all();
    $validation = Validator(
      $createJualBeli,
      [
        'merk' => [
          'required',
          'min:1',
          'max:30',
        ],
        'tipe' => [
          'required',
          'min:1',
          'max:30',
        ],
        'tahun' => [
          'required',
          'integer',
          'date_format:Y',
        ],
        'foto_mobil' => [
          'required',
          'image',
        ],
        'pemilik' => [
          'required',
          'min:3',
          'max:50',
        ],
        'lokasi' => [
          'required',
        ],
        'kapasitas_mesin' => [
          'required',
          'integer',
          'min:100',
          'max:10000',
        ],
        'tanggal_inspeksi' => [
          'required',
          'date_format:Y-m-d',
          'date',
        ],
        'riwayat' => [
          'required',
          'min:3',
          'max:100',
        ],
        'jenis_bahan_bakar' => [
          'required',
          'min:1',
          'max:30',
        ],
        'jenis_transmisi' => [
          'required',
          'min:1',
          'max:30',
        ],
        'pajak_berlaku_hingga' => [
          'required',
          'date_format:Y-m-d',
          'date',
        ],
        'harga' => [
          'required',
          'integer',
          'min:1000000',
          'max:100000000000',
        ],
      ],
      [
        'merk.required' => 'Merk Tidak Boleh Kosong !',
        'merk.min' => 'Panjang Merk Minimal 1 Karakter !',
        'merk.max' => 'Panjang Merk Maksimal 30 Karakter !',

        'tipe.required' => 'Tipe Tidak Boleh Kosong !',
        'tipe.min' => 'Panjang Tipe Minimal 1 Karakter !',
        'tipe.max' => 'Panjang Tipe Maksimal 30 Karakter !',

        'tahun.required' => 'Tahun Tidak Boleh Kosong !',
        'tahun.integer' => 'Tahun Harus Berupa Angka !',
        'tahun.date_format' => 'Tahun Harus Sesuai Format (YYYY) !',

        'foto_mobil.required' => 'Foto Mobil Tidak Boleh Kosong !',
        'foto_mobil.image' => 'Foto Mobil Harus Berupa Gambar !',

        'pemilik.required' => 'Pemilik Tidak Boleh Kosong !',
        'pemilik.min' => 'Panjang Pemilik Minimal 3 Karakter !',
        'pemilik.max' => 'Panjang Pemilik Maksimal 50 Karakter !',

        'lokasi.required' => 'Lokasi Tidak Boleh Kosong !',

        'kapasitas_mesin.required' => 'Kapasitas Mesin Tidak Boleh Kosong !',
        'kapasitas_mesin.integer' => 'Kapasitas Mesin Harus Berupa Angka !',
        'kapasitas_mesin.min' => 'Kapasitas Mesin Minimal 100 cc !',
        'kapasitas_mesin.max' => 'Kapasitas Mesin Maksimal 10000 cc !',

        'tanggal_inspeksi.required' => 'Tanggal Inspeksi Tidak Boleh Kosong !',
        'tanggal_inspeksi.date_format' => 'Tanggal Inspeksi Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_inspeksi.date' => 'Tanggal Inspeksi Harus Berupa Format Tanggal !',

        'riwayat.required' => 'Riwayat Tidak Boleh Kosong !',
        'riwayat.min' => 'Panjang Riwayat Minimal 3 Karakter !',
        'riwayat.max' => 'Panjang Riwayat Maksimal 100 Karakter !',

        'jenis_bahan_bakar.required' => 'Jenis Bahan Bakar Tidak Boleh Kosong !',
        'jenis_bahan_bakar.min' => 'Panjang Jenis Bahan Bakar Minimal 1 Karakter !',
        'jenis_bahan_bakar.max' => 'Panjang Jenis Bahan Bakar Maksimal 30 Karakter !',

        'jenis_transmisi.required' => 'Jenis Transmisi Tidak Boleh Kosong !',
        'jenis_transmisi.min' => 'Panjang Jenis Transmisi Minimal 1 Karakter !',
        'jenis_transmisi.max' => 'Panjang Jenis Transmisi Maksimal 30 Karakter !',

        'pajak_berlaku_hingga.required' => 'Pajak Berlaku Hingga Tidak Boleh Kosong !',
        'pajak_berlaku_hingga.date_format' => 'Pajak Berlaku Hingga Harus Sesuai Format (YYYY-MM-DD) !',
        'pajak_berlaku_hingga.date' => 'Pajak Berlaku Hingga Harus Berupa Format Tanggal !',

        'harga.required' => 'Harga Tidak Boleh Kosong !',
        'harga.integer' => 'Harga Harus Berupa Angka !',
        'harga.min' => 'Harga Minimal Rp. 1.000.000 !',
        'harga.max' => 'Harga Maksimal Rp. 100.000.000.000 !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $jual_beli = JualBeli::create($createJualBeli);

      $foto_mobil_name = $jual_beli->id_jual_beli . '_' . $jual_beli->foto_mobil->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_mobil/' . $foto_mobil_name;
      $jual_beli->foto_mobil->storeAs('public/foto_mobil', $foto_mobil_name);
      $jual_beli->foto_mobil = $path;
      $jual_beli->save();
      $jual_beli = JualBeli::find($jual_beli->id_jual_beli);

      $response = array(
        'message' => 'Data Jual Beli Baru Berhasil Dibuat !',
        'jual_beli' => $jual_beli,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Jual Beli Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $jual_beli = JualBeli::all();

    if (count($jual_beli) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Jual Beli !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Jual Beli !',
        'jual_beli' => $jual_beli
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $jual_beli_old = JualBeli::find($id);
    $jual_beli_new = JualBeli::find($id);

    if (empty($jual_beli_old)) {
      return response(
        ['message' => 'Data Jual Beli Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateJualBeli = $request->all();
    $validation = Validator(
      $updateJualBeli,
      [
        'merk' => [
          'nullable',
          'min:1',
          'max:30',
        ],
        'tipe' => [
          'nullable',
          'min:1',
          'max:30',
        ],
        'tahun' => [
          'nullable',
          'integer',
          'date_format:Y',
        ],
        'foto_mobil' => [
          'nullable',
          'image',
        ],
        'pemilik' => [
          'nullable',
          'min:3',
          'max:50',
        ],
        'lokasi' => [
          'nullable',
        ],
        'kapasitas_mesin' => [
          'nullable',
          'integer',
          'min:100',
          'max:10000',
        ],
        'tanggal_inspeksi' => [
          'nullable',
          'date_format:Y-m-d',
          'date',
        ],
        'riwayat' => [
          'nullable',
          'min:3',
          'max:100',
        ],
        'jenis_bahan_bakar' => [
          'nullable',
          'min:1',
          'max:30',
        ],
        'jenis_transmisi' => [
          'nullable',
          'min:1',
          'max:30',
        ],
        'pajak_berlaku_hingga' => [
          'nullable',
          'date_format:Y-m-d',
          'date',
        ],
        'harga' => [
          'nullable',
          'integer',
          'min:1000000',
          'max:100000000000',
        ],
      ],
      [
        'merk.min' => 'Panjang Merk Minimal 1 Karakter !',
        'merk.max' => 'Panjang Merk Maksimal 30 Karakter !',

        'tipe.min' => 'Panjang Tipe Minimal 1 Karakter !',
        'tipe.max' => 'Panjang Tipe Maksimal 30 Karakter !',

        'tahun.integer' => 'Tahun Harus Berupa Angka !',
        'tahun.date_format' => 'Tahun Harus Sesuai Format (YYYY) !',

        'foto_mobil.image' => 'Foto Mobil Harus Berupa Gambar !',

        'pemilik.min' => 'Panjang Pemilik Minimal 3 Karakter !',
        'pemilik.max' => 'Panjang Pemilik Maksimal 50 Karakter !',


        'kapasitas_mesin.integer' => 'Kapasitas Mesin Harus Berupa Angka !',
        'kapasitas_mesin.min' => 'Kapasitas Mesin Minimal 100 cc !',
        'kapasitas_mesin.max' => 'Kapasitas Mesin Maksimal 10000 cc !',

        'tanggal_inspeksi.date_format' => 'Tanggal Inspeksi Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_inspeksi.date' => 'Tanggal Inspeksi Harus Berupa Format Tanggal !',

        'riwayat.min' => 'Panjang Riwayat Minimal 3 Karakter !',
        'riwayat.max' => 'Panjang Riwayat Maksimal 100 Karakter !',

        'jenis_bahan_bakar.min' => 'Panjang Jenis Bahan Bakar Minimal 1 Karakter !',
        'jenis_bahan_bakar.max' => 'Panjang Jenis Bahan Bakar Maksimal 30 Karakter !',

        'jenis_transmisi.min' => 'Panjang Jenis Transmisi Minimal 1 Karakter !',
        'jenis_transmisi.max' => 'Panjang Jenis Transmisi Maksimal 30 Karakter !',

        'pajak_berlaku_hingga.date_format' => 'Pajak Berlaku Hingga Harus Sesuai Format (YYYY-MM-DD) !',
        'pajak_berlaku_hingga.date' => 'Pajak Berlaku Hingga Harus Berupa Format Tanggal !',

        'harga.integer' => 'Harga Harus Berupa Angka !',
        'harga.min' => 'Harga Minimal Rp. 1.000.000 !',
        'harga.max' => 'Harga Maksimal Rp. 100.000.000.000 !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateJualBeli['merk'])) {
        $jual_beli_new->merk = $updateJualBeli['merk'];
      }

      if (!empty($updateJualBeli['tipe'])) {
        $jual_beli_new->tipe = $updateJualBeli['tipe'];
      }

      if (!empty($updateJualBeli['tahun'])) {
        $jual_beli_new->tahun = $updateJualBeli['tahun'];
      }

      if (!empty($updateJualBeli['foto_mobil'])) {
        $foto_mobil_name = $jual_beli_new->id_jual_beli . '_' . $updateJualBeli['foto_mobil']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_mobil/' . $foto_mobil_name;
        $updateJualBeli['foto_mobil']->storeAs('public/foto_mobil', $foto_mobil_name);

        $jual_beli_new->foto_mobil = $path;
      }

      if (!empty($updateJualBeli['pemilik'])) {
        $jual_beli_new->pemilik = $updateJualBeli['pemilik'];
      }

      if (!empty($updateJualBeli['lokasi'])) {
        $jual_beli_new->lokasi = $updateJualBeli['lokasi'];
      }

      if (!empty($updateJualBeli['kapasitas_mesin'])) {
        $jual_beli_new->kapasitas_mesin = $updateJualBeli['kapasitas_mesin'];
      }

      if (!empty($updateJualBeli['tanggal_inspeksi'])) {
        $jual_beli_new->tanggal_inspeksi = $updateJualBeli['tanggal_inspeksi'];
      }

      if (!empty($updateJualBeli['riwayat'])) {
        $jual_beli_new->riwayat = $updateJualBeli['riwayat'];
      }

      if (!empty($updateJualBeli['jenis_bahan_bakar'])) {
        $jual_beli_new->jenis_bahan_bakar = $updateJualBeli['jenis_bahan_bakar'];
      }

      if (!empty($updateJualBeli['jenis_transmisi'])) {
        $jual_beli_new->jenis_transmisi = $updateJualBeli['jenis_transmisi'];
      }

      if (!empty($updateJualBeli['pajak_berlaku_hingga'])) {
        $jual_beli_new->pajak_berlaku_hingga = $updateJualBeli['pajak_berlaku_hingga'];
      }

      if (!empty($updateJualBeli['harga'])) {
        $jual_beli_new->harga = $updateJualBeli['harga'];
      }

      $jual_beli_new->save();
      $jual_beli_new = JualBeli::find($id);

      return response(
        [
          'message' => 'Data Jual Beli Berhasil Diubah !',
          'jual_beli_old' => $jual_beli_old,
          'jual_beli_new' => $jual_beli_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Jual Beli Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $jual_beli_old = JualBeli::find($id);
    $jual_beli_new = JualBeli::find($id);

    if (empty($jual_beli_old)) {
      return response(
        ['message' => 'Data Jual Beli Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Data Jual Beli Berhasil Dihapus !',
      'jual_beli_old' => $jual_beli_old,
    );

    try {
      $foto_mobil_path = URL::to('/') . '/storage/foto_mobil/';
      $foto_mobil_name = str_replace($foto_mobil_path, '', $jual_beli_old->foto_mobil);
      Storage::delete('public/foto_mobil/' . $foto_mobil_name);

      $jual_beli_new->delete();

      return response(
        $response,
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Jual Beli Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $jual_beli = JualBeli::find($id);

    if (empty($jual_beli)) {
      return response(
        ['message' => 'Data Jual Beli Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Jual Beli !',
        'jual_beli' => $jual_beli,
      ],
      HttpCode::$ok
    );
  }
}
