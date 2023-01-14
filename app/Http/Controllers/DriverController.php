<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use App\Utils\HttpCode;
use App\Utils\Utils;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
  public function Read()
  {
    $driver = Driver::all();

    if (count($driver) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Driver !'],
        HttpCode::$not_found
      );
    }

    for ($a = 0; $a < count($driver); $a++) {
      $user[$a] = User::find($driver[$a]->id_user);
    }

    $response = array(
      'message' => 'Menampilkan Semua Data Driver !',
      'driver' => $user,
    );

    foreach ($user as $user) {
      $this->ShowAllPair($user);
    }

    return response(
      $response,
      HttpCode::$ok
    );
  }

  public function Delete($id)
  {
    $driver_old = json_decode(DB::table('user')
      ->join('driver', 'user.id_user', '=', 'driver.id_user')
      ->where('id_driver', '=', $id)
      ->get(), true);

    $driver_new = Driver::find($id);

    if (empty($driver_old)) {
      return response(
        ['message' => 'Data Driver Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $user = User::find($driver_old[0]['id_user']);

    $response = array(
      'message' => 'Data Driver Berhasil Dihapus !',
      'driver_old' => $user,
    );

    $this->ShowAllPair($user);

    try {
      $foto_profil_path = URL::to('/') . '/storage/foto_profil/';
      $foto_ktp_path = URL::to('/') . '/storage/foto_ktp/';
      $foto_sim_path = URL::to('/') . '/storage/foto_sim/';

      $foto_profil_name = str_replace($foto_profil_path, '', $user->foto_profil);
      $foto_ktp_name = str_replace($foto_ktp_path, '', $user->foto_ktp);
      $foto_sim_name = str_replace($foto_sim_path, '', $driver_old[0]['foto_sim']);

      Storage::delete('public/foto_profil/' . $foto_profil_name);
      Storage::delete('public/foto_ktp/' . $foto_ktp_name);
      Storage::delete('public/foto_sim/' . $foto_sim_name);

      $driver_new->delete();
      DB::table('ulasan')->where('id_user', '=', $driver_old[0]['id_user'])->delete();
      DB::table('user')->where('id_user', '=', $driver_old[0]['id_user'])->delete();

      return response(
        $response,
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Driver Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $driver = Driver::find($id);

    if (empty($driver)) {
      return response(
        ['message' => 'Data Driver Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $user = User::find($driver->id_user);

    $response = array(
      'message' => 'Menampilkan Data Driver !',
      'driver' => $user,
    );

    $this->ShowAllPair($user);

    return response(
      $response,
      HttpCode::$ok
    );
  }

  private function ShowAllPair($user)
  {
    $driver = json_decode(DB::table('driver')
      ->where('id_user', '=', $user->id_user)
      ->get(), true);

    $user['driver'] = $driver[0];

    $ulasan = json_decode(DB::table('ulasan')
      ->where('id_user', '=', $user->id_user)
      ->get(), true);

    $user['ulasan'] = $ulasan;

    return $user;
  }
}
