<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\User;
use App\Utils\HttpCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ArmadaController extends Controller
{
  public function Create(Request $request)
  {
    $createArmada = $request->all();
    $validation = Validator(
      $createArmada,
      [
        'id_user' => [
          'required',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($createArmada['id_user']) ?
              (empty(User::find($createArmada['id_user'])) ||
                User::find($createArmada['id_user'])->id_role != 4) :
              false
          ),
        ],
        'jenis_kendaraan' => [
          'required',
          Rule::in(['Kecil', 'Truk', 'Alat Berat']),
        ],
        'merk_kendaraan' => [
          'required',
          'min:3',
          'max:30',
        ],
        'plat_nomor' => [
          'required',
          'regex:/^[A-Z]{1,2}\s{1}\d{1,4}\s{1}[A-Z]{1,3}$/',
          'min:5',
          'max:11',
          'unique:armada',
        ],
        'nomor_mesin' => [
          'required',
          'min:1',
          'max:15',
          'unique:armada',
        ],
        'kondisi_mesin' => [
          'required',
          Rule::in(['Tidak Baik', 'Baik']),
        ],
        'kondisi_ban' => [
          'required',
          Rule::in(['Gundul', 'Retak-Retak', 'Baru']),
        ],
        'kondisi_mobil' => [
          'required',
          Rule::in(['Butuh Service', 'Baik']),
        ],
        'batas_muatan' => [
          'required',
          'integer',
          'min:1',
          'max:50000', //50 ton
        ],
        'tanggal_beli' => [
          'required',
          'date_format:Y-m-d',
          'date',
          'before:' . Carbon::now(),
          'after:' . strtotime(Carbon::now() . ' -70 year'),
        ],
        'foto_armada' => [
          'required',
          'image',
        ],
      ],
      [
        'id_user.required' => 'ID User Tidak Boleh Kosong !',
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Armada !',

        'jenis_kendaraan.required' => 'Jenis Kendaraan Tidak Boleh Kosong !',
        'jenis_kendaraan.in' => 'Jenis Kendaraan Harus Salah Satu Dari (Kecil, Truk, Alat Berat) !',

        'merk_kendaraan.required' => 'Merk Kendaraan Tidak Boleh Kosong !',
        'merk_kendaraan.min' => 'Panjang Merk Kendaraan Minimal 3 Karakter !',
        'merk_kendaraan.max' => 'Panjang Merk Kendaraan Maksimal 30 Karakter !',

        'plat_nomor.required' => 'Plat Nomor Tidak Boleh Kosong !',
        'plat_nomor.regex' => 'Plat Nomor Harus Sesuai Format (X Y Z) !',
        'plat_nomor.min' => 'Panjang Plat Nomor Minimal 5 Karakter !',
        'plat_nomor.max' => 'Panjang Plat Nomor Maksimal 11 Karakter !',
        'plat_nomor.unique' => 'Plat Nomor Sudah Terdaftar !',

        'nomor_mesin.required' => 'Nomor Mesin Tidak Boleh Kosong !',
        'nomor_mesin.min' => 'Panjang Nomor Mesin Minimal 1 Karakter !',
        'nomor_mesin.max' => 'Panjang Nomor Mesin Maksimal 15 Karakter !',
        'nomor_mesin.unique' => 'Nomor Mesin Sudah Terdaftar !',

        'kondisi_mesin.required' => 'Kondisi Mesin Tidak Boleh Kosong !',
        'kondisi_mesin.in' => 'Kondisi Mesin Harus Salah Satu Dari (Tidak Baik, Baik) !',

        'kondisi_ban.required' => 'Kondisi Ban Tidak Boleh Kosong !',
        'kondisi_ban.in' => 'Kondisi Ban Harus Salah Satu Dari (Gundul, Retak-Retak, Baru) !',

        'kondisi_mobil.required' => 'Kondisi Mobil Tidak Boleh Kosong !',
        'kondisi_mobil.in' => 'Kondisi Mobil Harus Salah Satu Dari (Butuh Service, Baik) !',

        'batas_muatan.required' => 'Batas Muatan Tidak Boleh Kosong !',
        'batas_muatan.integer' => 'Batas Muatan Harus Berupa Angka !',
        'batas_muatan.min' => 'Batas Muatan Minimal 1 Kg !',
        'batas_muatan.max' => 'Batas Muatan Maksimal 50000 Kg !',

        'tanggal_beli.required' => 'Tanggal Beli Tidak Boleh Kosong !',
        'tanggal_beli.date_format' => 'Tanggal Beli Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_beli.date' => 'Tanggal Beli Harus Berupa Format Tanggal !',
        'tanggal_beli.before' => 'Tanggal Beli Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_beli.after' => 'Tanggal Beli Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_armada.required' => 'Foto Armada Tidak Boleh Kosong !',
        'foto_armada.image' => 'Foto Armada Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $armada = Armada::create($createArmada);

      $foto_armada_name = $armada->id_user . '_' . $armada->id_armada . '_' . $armada->foto_armada->getClientOriginalName();
      $path = URL::to('/') . '/storage/foto_armada/' . $foto_armada_name;
      $armada->foto_armada->storeAs('public/foto_armada', $foto_armada_name);
      $armada->foto_armada = $path;
      $armada->save();
      $armada = Armada::find($armada->id_armada);

      $response = array(
        'message' => 'Data Armada Baru Berhasil Dibuat !',
        'armada' => $armada,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Armada Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $armada = Armada::all();

    if (count($armada) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Armada !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Menampilkan Semua Data Armada !',
      'armada' => $armada,
    );

    foreach ($armada as $armada) {
      $this->ShowAllPair($armada);
    }

    return response(
      $response,
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $armada_old = Armada::find($id);
    $armada_new = Armada::find($id);

    if (empty($armada_old)) {
      return response(
        ['message' => 'Data Armada Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateArmada = $request->all();
    $validation = Validator(
      $updateArmada,
      [
        'id_user' => [
          'nullable',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($updateArmada['id_user']) ?
              (empty(User::find($updateArmada['id_user'])) ||
                User::find($updateArmada['id_user'])->id_role != 4) :
              false
          ),
        ],
        'jenis_kendaraan' => [
          'nullable',
          Rule::in(['Kecil', 'Truk', 'Alat Berat']),
        ],
        'merk_kendaraan' => [
          'nullable',
          'min:3',
          'max:30',
        ],
        'plat_nomor' => [
          'nullable',
          'regex:/^[A-Z]{1,2}\s{1}\d{1,4}\s{1}[A-Z]{1,3}$/',
          'min:5',
          'max:11',
          Rule::unique('armada')->ignore($armada_old),
        ],
        'nomor_mesin' => [
          'nullable',
          'min:1',
          'max:15',
          Rule::unique('armada')->ignore($armada_old),
        ],
        'kondisi_mesin' => [
          'nullable',
          Rule::in(['Tidak Baik', 'Baik']),
        ],
        'kondisi_ban' => [
          'nullable',
          Rule::in(['Gundul', 'Retak-Retak', 'Baru']),
        ],
        'kondisi_mobil' => [
          'nullable',
          Rule::in(['Butuh Service', 'Baik']),
        ],
        'batas_muatan' => [
          'nullable',
          'integer',
          'min:1',
          'max:50000', //50 ton
        ],
        'tanggal_beli' => [
          'nullable',
          'date_format:Y-m-d',
          'date',
          'before:' . Carbon::now(),
          'after:' . strtotime(Carbon::now() . ' -70 year'),
        ],
        'foto_armada' => [
          'nullable',
          'image',
        ],
        'status' => [
          'nullable',
          Rule::in(['Tidak Tersedia', 'Tersedia']),
        ],
      ],
      [
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Armada !',

        'jenis_kendaraan.in' => 'Jenis Kendaraan Harus Salah Satu Dari (Kecil, Truk, Alat Berat) !',

        'merk_kendaraan.min' => 'Panjang Merk Kendaraan Minimal 3 Karakter !',
        'merk_kendaraan.max' => 'Panjang Merk Kendaraan Maksimal 30 Karakter !',

        'plat_nomor.regex' => 'Plat Nomor Harus Sesuai Format (X Y Z) !',
        'plat_nomor.min' => 'Panjang Plat Nomor Minimal 5 Karakter !',
        'plat_nomor.max' => 'Panjang Plat Nomor Maksimal 11 Karakter !',
        'plat_nomor.unique' => 'Plat Nomor Sudah Terdaftar !',

        'nomor_mesin.min' => 'Panjang Nomor Mesin Minimal 1 Karakter !',
        'nomor_mesin.max' => 'Panjang Nomor Mesin Maksimal 15 Karakter !',
        'nomor_mesin.unique' => 'Nomor Mesin Sudah Terdaftar !',

        'kondisi_mesin.in' => 'Kondisi Mesin Harus Salah Satu Dari (Tidak Baik, Baik) !',

        'kondisi_ban.in' => 'Kondisi Ban Harus Salah Satu Dari (Gundul, Retak-Retak, Baru) !',

        'kondisi_mobil.in' => 'Kondisi Mobil Harus Salah Satu Dari (Butuh Service, Baik) !',

        'batas_muatan.integer' => 'Batas Muatan Harus Berupa Angka !',
        'batas_muatan.min' => 'Batas Muatan Minimal 1 Kg !',
        'batas_muatan.max' => 'Batas Muatan Maksimal 50000 Kg !',

        'tanggal_beli.date_format' => 'Tanggal Beli Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_beli.date' => 'Tanggal Beli Harus Berupa Format Tanggal !',
        'tanggal_beli.before' => 'Tanggal Beli Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_beli.after' => 'Tanggal Beli Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_armada.image' => 'Foto Armada Harus Berupa Gambar !',

        'status.in' => 'Status Harus Salah Satu Dari (Tidak Tersedia, Tersedia) !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateArmada['id_user'])) {
        $armada_new->id_user = $updateArmada['id_user'];
      }

      if (!empty($updateArmada['jenis_kendaraan'])) {
        $armada_new->jenis_kendaraan = $updateArmada['jenis_kendaraan'];
      }

      if (!empty($updateArmada['merk_kendaraan'])) {
        $armada_new->merk_kendaraan = $updateArmada['merk_kendaraan'];
      }

      if (!empty($updateArmada['plat_nomor'])) {
        $armada_new->plat_nomor = $updateArmada['plat_nomor'];
      }

      if (!empty($updateArmada['nomor_mesin'])) {
        $armada_new->nomor_mesin = $updateArmada['nomor_mesin'];
      }

      if (!empty($updateArmada['kondisi_mesin'])) {
        $armada_new->kondisi_mesin = $updateArmada['kondisi_mesin'];
      }

      if (!empty($updateArmada['kondisi_ban'])) {
        $armada_new->kondisi_ban = $updateArmada['kondisi_ban'];
      }

      if (!empty($updateArmada['kondisi_mobil'])) {
        $armada_new->kondisi_mobil = $updateArmada['kondisi_mobil'];
      }

      if (!empty($updateArmada['batas_muatan'])) {
        $armada_new->batas_muatan = $updateArmada['batas_muatan'];
      }

      if (!empty($updateArmada['tanggal_beli'])) {
        $armada_new->tanggal_beli = $updateArmada['tanggal_beli'];
      }

      if (!empty($updateArmada['foto_armada'])) {
        $foto_armada_name = $armada_new->id_user . '_' . $armada_new->id_armada . '_' . $updateArmada['foto_armada']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_armada/' . $foto_armada_name;
        $updateArmada['foto_armada']->storeAs('public/foto_armada', $foto_armada_name);

        $armada_new->foto_armada = $path;
      }

      if (!empty($updateArmada['status'])) {
        $armada_new->status = $updateArmada['status'];
      }

      $armada_new->save();
      $armada_new = Armada::find($id);

      return response(
        [
          'message' => 'Data Armada Berhasil Diubah !',
          'armada_old' => $armada_old,
          'armada_new' => $armada_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Armada Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $armada_old = Armada::find($id);
    $armada_new = Armada::find($id);

    if (empty($armada_old)) {
      return response(
        ['message' => 'Data Armada Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Data Armada Berhasil Dihapus !',
      'armada_old' => $armada_old,
    );

    $this->ShowAllPair($armada_old);

    try {
      $foto_armada_path = URL::to('/') . '/storage/foto_armada/';
      $foto_armada_name = str_replace($foto_armada_path, '', $armada_old->foto_armada);
      Storage::delete('public/foto_armada/' . $foto_armada_name);

      DB::table('trayek')
        ->where('id_armada', '=', $armada_old->id_armada)
        ->delete();

      $armada_new->delete();

      return response(
        $response,
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Armada Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $armada = Armada::find($id);

    if (empty($armada)) {
      return response(
        ['message' => 'Data Armada Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Menampilkan Data Armada !',
      'armada' => $armada,
    );

    $this->ShowAllPair($armada);

    return response(
      $response,
      HttpCode::$ok
    );
  }

  private function ShowAllPair($armada)
  {
    $trayek = json_decode(DB::table('trayek')
      ->where('id_armada', '=', $armada->id_armada)
      ->get(), true);

    $armada['trayek'] = $trayek;

    return $armada;
  }
}
