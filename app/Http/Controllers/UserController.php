<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use App\Utils\HttpCode;
use App\Utils\Utils;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
  public function Login(Request $request)
  {
    $loginUser = $request->all();
    $validation = Validator(
      $loginUser,
      [
        'email' => [
          'required',
          'regex:/^\w+[@]\w+[.]\w+$/',
          'email:rfc,dns',
          'min:5',
          'max:50',
        ],
        'password' => [
          'required',
          'min:6',
          'max:20',
        ],
      ],
      [
        'email.required' => 'Email Tidak Boleh Kosong !',
        'email.regex' => 'Email Harus Sesuai Format (X@X.X) !',
        'email.email' => 'Email Harus Berupa Format Email !',
        'email.min' => 'Panjang Email Minimal 5 Karakter !',
        'email.max' => 'Panjang Email Maksimal 40 Karakter !',

        'password.required' => 'Password Tidak Boleh Kosong !',
        'password.min' => 'Panjang Password Minimal 6 Karakter !',
        'password.max' => 'Panjang Password Maksimal 20 Karakter !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $message = 'Login Gagal !';
      $login = false;
      $id_user = null;

      if (Auth::attempt($loginUser)) {
        $message = 'Login Berhasil !';
        $login = true;
        $id_user = Auth::user()->id_user;
      }

      return response(
        [
          'message' => $message,
          'login' => $login,
          'id_user' => $id_user,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Login Gagal !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Create(Request $request)
  {
    $createUser = $request->all();
    $validation = Validator(
      $createUser,
      [
        'role' => [
          'required',
          Rule::in([
            'Driver',
            'Pemilik Armada',
            'Pemilik Bengkel',
            'Pemilik Kios BBM',
            'Pemilik Order',
            'Pemilik Toko Sparepart'
          ]),
        ],
        'nama_lengkap' => [
          'required',
          'min:3',
          'max:60',
        ],
        'jenis_kelamin' => [
          'required',
          Rule::in(['Laki-Laki', 'Perempuan']),
        ],
        'tanggal_lahir' => [
          'required',
          'date_format:Y-m-d',
          'date',
          'before:' . Carbon::now(),
          'after:' . strtotime(Carbon::now() . ' -70 year'),
        ],
        'foto_profil' => [
          'nullable',
          'image',
        ],
        'foto_ktp' => [
          'nullable',
          'image',
        ],
        'alamat' => [
          'nullable',
          'min:10',
          'max:100',
        ],
        'nomor_hp' => [
          'required',
          'regex:/^08[1-9]{1}[0-9]{7,10}$/',
          'numeric',
          'starts_with:08',
          'digits_between:10,13',
          'unique:user',
        ],
        'email' => [
          'required',
          'regex:/^\w+[@]\w+[.]\w+$/',
          'email:rfc,dns',
          'min:5',
          'max:50',
          'unique:user',
        ],
        'password' => [
          'required',
          'min:6',
          'max:20',
        ],

        //Khusus Driver
        'pengalaman' => [
          Rule::requiredIf(strcmp($createUser['role'], 'Driver') == 0),
          'min:10',
          'max:1000',
        ],
        'foto_sim' => [
          Rule::requiredIf(strcmp($createUser['role'], 'Driver') == 0),
          'image',
        ],

      ],
      [
        'role.required' => 'Role Tidak Boleh Kosong !',
        'role.in' => 'Role Harus Salah Satu Dari (Driver, Pemilik Armada, Pemilik Bengkel, Pemilik Kios BBM, Pemilik Order, Pemilik Toko Sparepart) !',

        'nama_lengkap.required' => 'Nama Lengkap Tidak Boleh Kosong !',
        'nama_lengkap.min' => 'Panjang Nama Lengkap Minimal 3 Karakter !',
        'nama_lengkap.max' => 'Panjang Nama Lengkap Maksimal 60 Karakter !',

        'jenis_kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong !',
        'jenis_kelamin.in' => 'Jenis Kelamin Harus Salah Satu Dari (Laki-Laki, Perempuan) !',

        'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong !',
        'tanggal_lahir.date_format' => 'Tanggal Lahir Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Format Tanggal !',
        'tanggal_lahir.before' => 'Tanggal Lahir Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_lahir.after' => 'Tanggal Lahir Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_profil.image' => 'Foto Profil Harus Berupa Gambar !',

        'foto_ktp.image' => 'Foto KTP Harus Berupa Gambar !',

        'alamat.min' => 'Panjang Alamat Minimal 10 Karakter !',
        'alamat.max' => 'Panjang Alamat Maksimal 100 Karakter !',

        'nomor_hp.required' => 'Nomor HP Tidak Boleh Kosong !',
        'nomor_hp.regex' => 'Nomor HP Harus Sesuai Format (08XXXXXXXXXX) !',
        'nomor_hp.numeric' => 'Nomor HP Harus Berupa Angka !',
        'nomor_hp.starts_with' => 'Nomor HP Harus Diawali Angka 08 !',
        'nomor_hp.digits_between' => 'Nomor HP Harus Diantara 10 Sampai 13 Digit !',
        'nomor_hp.unique' => 'Nomor HP Sudah Terdaftar !',

        'email.required' => 'Email Tidak Boleh Kosong !',
        'email.regex' => 'Email Harus Sesuai Format (X@X.X) !',
        'email.email' => 'Email Harus Berupa Format Email !',
        'email.min' => 'Panjang Email Minimal 5 Karakter !',
        'email.max' => 'Panjang Email Maksimal 40 Karakter !',
        'email.unique' => 'Email Sudah Terdaftar !',

        'password.required' => 'Password Tidak Boleh Kosong !',
        'password.min' => 'Panjang Password Minimal 6 Karakter !',
        'password.max' => 'Panjang Password Maksimal 20 Karakter !',

        'pengalaman.required' => 'Pengalaman Tidak Boleh Kosong !',
        'pengalaman.min' => 'Panjang Pengalaman Minimal 10 Karakter !',
        'pengalaman.max' => 'Panjang Pengalaman Maksimal 1000 Karakter !',

        'foto_sim.required' => 'Foto SIM Tidak Boleh Kosong !',
        'foto_sim.image' => 'Foto SIM Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $role = json_decode(DB::table('role')
        ->where('nama_role', '=', $createUser['role'])
        ->get(), true);

      $nama = Utils::PembagiNama($createUser['nama_lengkap']);

      $createUser['id_role'] = $role[0]['id_role'];
      $createUser['nama_depan'] = $nama[0];
      $createUser['nama_belakang'] = $nama[1];
      $createUser['password'] = password_hash($createUser['password'], PASSWORD_BCRYPT);

      $user = User::create($createUser);

      if (!empty($createUser['foto_profil'])) {
        $foto_profil_name = $user->id_user . '_' . $user->foto_profil->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_profil/' . $foto_profil_name;
        $user->foto_profil->storeAs('public/foto_profil', $foto_profil_name);
        $user->foto_profil = $path;
        $user->save();
      }

      if (!empty($createUser['foto_ktp'])) {
        $foto_ktp_name = $user->id_user . '_' . $user->foto_ktp->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_ktp/' . $foto_ktp_name;
        $user->foto_ktp->storeAs('public/foto_ktp', $foto_ktp_name);
        $user->foto_ktp = $path;
        $user->save();
      }

      if ($role[0]['id_role'] == 3) //Khusus Driver
      {
        $driver = Driver::create([
          'id_user' => $user->id_user,
          'pengalaman' => $createUser['pengalaman'],
          'foto_sim' => $createUser['foto_sim'],
        ]);

        $foto_sim_name = $driver->id_driver . '_' . $driver->foto_sim->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_sim/' . $foto_sim_name;
        $driver->foto_sim->storeAs('public/foto_sim', $foto_sim_name);
        $driver->foto_sim = $path;
        $driver->save();

        $user = json_decode(DB::table('user')
          ->join('driver', 'user.id_user', '=', 'driver.id_user')
          ->where('id_driver', '=', $driver->id_driver)
          ->get(), true);
      } else {
        $user = User::Find($user->id_user);
      }

      $user_title = Str::lower(str_replace(' ', '_', $createUser['role']));

      $response = array(
        'message' => 'Data ' . $createUser['role'] . ' Baru Berhasil Dibuat !',
        $user_title => $user,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data ' . $createUser['role'] . ' Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function ReadAll()
  {
    $user = User::all();

    if (count($user) < 1) {
      return response(
        ['message' => 'Tidak Ada Data User !'],
        HttpCode::$not_found
      );
    }

    $response = array(
      'message' => 'Menampilkan Semua Data User !',
      'user' => $user,
    );

    foreach ($user as $user) {
      $this->ShowAllPairs($user);
    }

    return response(
      $response,
      HttpCode::$ok
    );
  }

  public function Read($role)
  {
    $role = str_replace('-', ' ', $role);
    $role = json_decode(DB::table('role')
      ->where('nama_role', '=', $role)
      ->get(), true);

    if (empty($role)) {
      return response(
        ['message' => 'Role Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $user = json_decode(DB::table('user')
      ->where('id_role', '=', $role[0]['id_role'])
      ->get(), true);

    if (count($user) < 1) {
      return response(
        ['message' => 'Tidak Ada Data ' . $role[0]['nama_role'] . ' !'],
        HttpCode::$not_found
      );
    }

    for ($a = 0; $a < count($user); $a++) {
      $user[$a] = $this->ShowAllPair($user[$a], $role[0]['id_role']);
    }

    $user_title = Str::lower(str_replace(' ', '_', $role[0]['nama_role']));

    $response = array(
      'message' => 'Menampilkan Semua Data ' . $role[0]['nama_role'] . ' !',
      $user_title => $user,
    );

    return response(
      $response,
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $user_old = User::find($id);
    $user_new = User::find($id);

    if (empty($user_old)) {
      return response(
        ['message' => 'Data User Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateUser = $request->all();
    $validation = Validator(
      $updateUser,
      [
        'nama_lengkap' => [
          'nullable',
          'min:3',
          'max:60',
        ],
        'jenis_kelamin' => [
          'nullable',
          Rule::in(['Laki-Laki', 'Perempuan']),
        ],
        'tanggal_lahir' => [
          'nullable',
          'date_format:Y-m-d',
          'date',
          'before:' . Carbon::now(),
          'after:' . strtotime(Carbon::now() . ' -70 year'),
        ],
        'foto_profil' => [
          'nullable',
          'image',
        ],
        'foto_ktp' => [
          'nullable',
          'image',
        ],
        'alamat' => [
          'nullable',
          'min:10',
          'max:100',
        ],
        'nomor_hp' => [
          'nullable',
          'regex:/^08[1-9]{1}[0-9]{7,10}$/',
          'numeric',
          'starts_with:08',
          'digits_between:10,13',
          Rule::unique('user')->ignore($user_old),
        ],
        'email' => [
          'nullable',
          'regex:/^\w+[@]\w+[.]\w+$/',
          'email:rfc,dns',
          'min:5',
          'max:50',
          Rule::unique('user')->ignore($user_old),
        ],
        'password' => [
          'nullable',
          'min:6',
          'max:20',
        ],

        //Khusus Driver
        'pengalaman' => [
          Rule::prohibitedIf($user_old->id_role != 3),
          'nullable',
          'min:10',
          'max:1000',
        ],
        'foto_sim' => [
          Rule::prohibitedIf($user_old->id_role != 3),
          'nullable',
          'image',
        ],

      ],
      [
        'role.in' => 'Role Harus Salah Satu Dari (Driver, Pemilik Armada, Pemilik Bengkel, Pemilik Kios BBM, Pemilik Order, Pemilik Toko Sparepart) !',

        'nama_lengkap.min' => 'Panjang Nama Lengkap Minimal 3 Karakter !',
        'nama_lengkap.max' => 'Panjang Nama Lengkap Maksimal 60 Karakter !',

        'jenis_kelamin.in' => 'Jenis Kelamin Harus Salah Satu Dari (Laki-Laki, Perempuan) !',

        'tanggal_lahir.date_format' => 'Tanggal Lahir Harus Sesuai Format (YYYY-MM-DD) !',
        'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Format Tanggal !',
        'tanggal_lahir.before' => 'Tanggal Lahir Harus Kurang Dari Tanggal Sekarang !',
        'tanggal_lahir.after' => 'Tanggal Lahir Harus Lebih Dari 70 Tahun Yang Lalu !',

        'foto_profil.image' => 'Foto Profil Harus Berupa Gambar !',

        'foto_ktp.image' => 'Foto KTP Harus Berupa Gambar !',

        'alamat.min' => 'Panjang Alamat Minimal 10 Karakter !',
        'alamat.max' => 'Panjang Alamat Maksimal 100 Karakter !',

        'nomor_hp.regex' => 'Nomor HP Harus Sesuai Format (08XXXXXXXXXX) !',
        'nomor_hp.numeric' => 'Nomor HP Harus Berupa Angka !',
        'nomor_hp.starts_with' => 'Nomor HP Harus Diawali Angka 08 !',
        'nomor_hp.digits_between' => 'Nomor HP Harus Diantara 10 Sampai 13 Digit !',
        'nomor_hp.unique' => 'Nomor HP Sudah Terdaftar !',

        'email.regex' => 'Email Harus Sesuai Format (X@X.X) !',
        'email.email' => 'Email Harus Berupa Format Email !',
        'email.min' => 'Panjang Email Minimal 5 Karakter !',
        'email.max' => 'Panjang Email Maksimal 40 Karakter !',
        'email.unique' => 'Email Sudah Terdaftar !',

        'password.min' => 'Panjang Password Minimal 6 Karakter !',
        'password.max' => 'Panjang Password Maksimal 20 Karakter !',

        'pengalaman.prohibited' => 'Pengalaman Hanya Untuk Driver !',
        'pengalaman.min' => 'Panjang Pengalaman Minimal 10 Karakter !',
        'pengalaman.max' => 'Panjang Pengalaman Maksimal 1000 Karakter !',

        'foto_sim.prohibited' => 'Foto SIM Hanya Untuk Driver !',
        'foto_sim.image' => 'Foto SIM Harus Berupa Gambar !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    $role = json_decode(DB::table('role')
      ->where('id_role', '=', $user_old->id_role)
      ->get(), true);

    try {
      if (!empty($updateUser['nama_lengkap'])) {
        $nama = Utils::PembagiNama($updateUser['nama_lengkap']);
        $user_new->nama_depan = $nama[0];
        $user_new->nama_belakang = $nama[1];
      }

      if (!empty($updateUser['jenis_kelamin'])) {
        $user_new->jenis_kelamin = $updateUser['jenis_kelamin'];
      }

      if (!empty($updateUser['tanggal_lahir'])) {
        $user_new->tanggal_lahir = $updateUser['tanggal_lahir'];
      }

      if (!empty($updateUser['foto_profil'])) {
        $foto_profil_name = $user_new->id_user . '_' . $updateUser['foto_profil']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_profil/' . $foto_profil_name;
        $updateUser['foto_profil']->storeAs('public/foto_profil', $foto_profil_name);

        $user_new->foto_profil = $path;
      }

      if (!empty($updateUser['foto_ktp'])) {
        $foto_ktp_name = $user_new->id_user . '_' . $updateUser['foto_ktp']->getClientOriginalName();
        $path = URL::to('/') . '/storage/foto_ktp/' . $foto_ktp_name;
        $updateUser['foto_ktp']->storeAs('public/foto_ktp', $foto_ktp_name);

        $user_new->foto_ktp = $path;
      }

      if (!empty($updateUser['alamat'])) {
        $user_new->alamat = $updateUser['alamat'];
      }

      if (!empty($updateUser['nomor_hp'])) {
        $user_new->nomor_hp = $updateUser['nomor_hp'];
      }

      if (!empty($updateUser['email'])) {
        $user_new->email = $updateUser['email'];
      }

      if (!empty($updateUser['password'])) {
        $user_new->password = password_hash($updateUser['password'], PASSWORD_BCRYPT);
      }

      if ($user_old->id_role == 3) //Khusus Driver
      {
        $driver = Driver::find(json_decode(DB::table('user')
          ->join('driver', 'user.id_user', '=', 'driver.id_user')
          ->where('driver.id_user', '=', $user_old->id_user)
          ->get(), true)[0]['id_driver']);

        $user_old = json_decode(DB::table('user')
          ->join('driver', 'user.id_user', '=', 'driver.id_user')
          ->where('id_driver', '=', $driver->id_driver)
          ->get(), true);

        if (!empty($updateUser['pengalaman'])) {
          $driver->pengalaman = $updateUser['pengalaman'];
        }

        if (!empty($updateUser['foto_sim'])) {
          $foto_sim_name = $driver->id_driver . '_' . $updateUser['foto_sim']->getClientOriginalName();
          $path = URL::to('/') . '/storage/foto_sim/' . $foto_sim_name;
          $updateUser['foto_sim']->storeAs('public/foto_sim', $foto_sim_name);

          $driver->foto_sim = $path;
        }

        $driver->save();
      }

      $user_new->save();

      if ($role[0]['id_role'] == 3) //Khusus Driver
      {
        $user_new = json_decode(DB::table('user')
          ->join('driver', 'user.id_user', '=', 'driver.id_user')
          ->where('id_driver', '=', $driver->id_driver)
          ->get(), true);
      }

      $user_title = Str::lower(str_replace(' ', '_', $role[0]['nama_role']));

      $response = array(
        'message' => 'Data ' . $role[0]['nama_role'] . ' Berhasil Diubah !',
        $user_title . '_old' => $user_old,
        $user_title . '_new' => $user_new,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data ' . $role[0]['nama_role'] . ' Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $user_old = User::find($id);
    $user_new = User::find($id);

    if (empty($user_old)) {
      return response(
        ['message' => 'Data User Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    if ($user_old['id_role'] == 1) {
      return response(
        ['message' => 'Super Admin Tidak Boleh Dihapus !'],
        HttpCode::$not_acceptable
      );
    }

    if ($user_old['id_role'] == 2) {
      return response(
        ['message' => 'Admin Tidak Boleh Dihapus !'],
        HttpCode::$not_acceptable
      );
    }

    $role = json_decode(DB::table('role')
      ->where('id_role', '=', $user_old->id_role)
      ->get(), true);

    $user_title = Str::lower(str_replace(' ', '_', $role[0]['nama_role']));

    $response = array(
      'message' => 'Data ' . $role[0]['nama_role'] . ' Berhasil Dihapus !',
      $user_title . '_old' => $user_old,
    );

    $this->ShowAllPairs($user_old);

    try {
      $foto_profil_path = URL::to('/') . '/storage/foto_profil/';
      $foto_ktp_path = URL::to('/') . '/storage/foto_ktp/';

      $foto_profil_name = str_replace($foto_profil_path, '', $user_old->foto_profil);
      $foto_ktp_name = str_replace($foto_ktp_path, '', $user_old->foto_ktp);

      Storage::delete('public/foto_profil/' . $foto_profil_name);
      Storage::delete('public/foto_ktp/' . $foto_ktp_name);

      if ($user_old->id_role == 3) //Driver
      {
        $driver = json_decode(DB::table('driver')
          ->where('id_user', '=', $user_old->id_user)
          ->get(), true);

        $foto_sim_path = URL::to('/') . '/storage/foto_sim/';
        $foto_sim_name = str_replace($foto_sim_path, '', $driver[0]['foto_sim']);
        Storage::delete('public/foto_sim/' . $foto_sim_name);

        DB::table('driver')
          ->where('id_user', '=', $user_old->id_user)
          ->delete();
      } else if ($user_old->id_role == 4) //Pemilik Armada
      {
        foreach (json_decode(DB::table('armada')
          ->where('id_user', '=', $user_old->id_user)
          ->get(), true) as $armada) {
          DB::table('trayek')
            ->where('id_armada', '=', $armada['id_armada'])
            ->delete();
        }

        DB::table('armada')
          ->where('id_user', '=', $user_old->id_user)
          ->delete();
      } else if ($user_old->id_role == 5) //Pemilik Bengkel
      {
        DB::table('bengkel')
          ->where('id_user', '=', $user_old->id_user)
          ->delete();
      } else if ($user_old->id_role == 6) //Pemilik Kios BBM
      {
        DB::table('kios_bbm')
          ->where('id_user', '=', $user_old->id_user)
          ->delete();
      } else if ($user_old->id_role == 7) //Pemilik Order
      {
        DB::table('order')
          ->where('id_user', '=', $user_old->id_user)
          ->delete();
      } else if ($user_old->id_role == 8) //Pemilik Toko Sparepart
      {
        foreach (json_decode(DB::table('toko_sparepart')
          ->where('id_user', '=', $user_old->id_user)
          ->get(), true) as $toko_sparepart) {
          DB::table('sparepart')
            ->where('id_toko_sparepart', '=', $toko_sparepart['id_toko_sparepart'])
            ->delete();
        }

        DB::table('toko_sparepart')
          ->where('id_user', '=', $user_old->id_user)
          ->delete();
      }

      DB::table('ulasan')
        ->where('id_user', '=', $user_old->id_user)
        ->delete();

      $user_new->delete();

      return response(
        $response,
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data User Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $user = User::find($id);

    if (empty($user)) {
      return response(
        ['message' => 'Data User Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $role = json_decode(DB::table('role')
      ->where('id_role', '=', $user->id_role)
      ->get(), true);

    $user_title = Str::lower(str_replace(' ', '_', $role[0]['nama_role']));

    $response = array(
      'message' => 'Menampilkan Data ' . $role[0]['nama_role'] . ' !',
      'role' => $role[0]['nama_role'],
      $user_title => $user,
    );

    $this->ShowAllPairs($user);

    return response(
      $response,
      HttpCode::$ok
    );
  }

  private function ShowAllPairs($user)
  {
    $role = json_decode(DB::table('role')
      ->where('id_role', '=', $user->id_role)
      ->get(), true);

    $user['role'] = $role[0];

    if ($user['role']['id_role'] == 3) //Driver
    {
      $driver = json_decode(DB::table('driver')
        ->where('id_user', '=', $user->id_user)
        ->get(), true);

      $user['driver'] = $driver[0];
    } else if ($user['role']['id_role'] == 4) //Pemilik Armada
    {
      $armada = json_decode(DB::table('armada')
        ->where('id_user', '=', $user->id_user)
        ->get(), true);

      for ($a = 0; $a < count($armada); $a++) {
        $trayek = json_decode(DB::table('trayek')
          ->where('id_armada', '=', $armada[$a]['id_armada'])
          ->get(), true);

        $armada[$a]['trayek'] = $trayek;
      }

      $user['armada'] = $armada;
    } else if ($user['role']['id_role'] == 5) //Pemilik Bengkel
    {
      $bengkel = json_decode(DB::table('bengkel')
        ->where('id_user', '=', $user->id_user)
        ->get(), true);

      $user['bengkel'] = $bengkel;
    } else if ($user['role']['id_role'] == 6) //Pemilik Kios BBM
    {
      $kios_bbm = json_decode(DB::table('kios_bbm')
        ->where('id_user', '=', $user->id_user)
        ->get(), true);

      $user['kios_bbm'] = $kios_bbm;
    } else if ($user['role']['id_role'] == 7) //Pemilik Order
    {
      $order = json_decode(DB::table('order')
        ->where('id_user', '=', $user->id_user)
        ->get(), true);

      $user['order'] = $order;
    } else if ($user['role']['id_role'] == 8) //Pemilik Toko Sparepart
    {
      $toko_sparepart = json_decode(DB::table('toko_sparepart')
        ->where('id_user', '=', $user->id_user)
        ->get(), true);

      for ($a = 0; $a < count($toko_sparepart); $a++) {
        $sparepart = json_decode(DB::table('sparepart')
          ->where('id_toko_sparepart', '=', $toko_sparepart[$a]['id_toko_sparepart'])
          ->get(), true);

        $toko_sparepart[$a]['sparepart'] = $sparepart;
      }

      $user['toko_sparepart'] = $toko_sparepart;
    }

    $ulasan = json_decode(DB::table('ulasan')
      ->where('id_user', '=', $user->id_user)
      ->get(), true);

    $user['ulasan'] = $ulasan;

    return $user;
  }

  private function ShowAllPair($user, $id_role)
  {
    if ($id_role == 3) //Driver
    {
      $driver = json_decode(DB::table('driver')
        ->where('id_user', '=', $user['id_user'])
        ->get(), true);

      $user['driver'] = $driver[0];
    } else if ($id_role == 4) //Pemilik Armada
    {
      $armada = json_decode(DB::table('armada')
        ->where('id_user', '=', $user['id_user'])
        ->get(), true);

      for ($a = 0; $a < count($armada); $a++) {
        $trayek = json_decode(DB::table('trayek')
          ->where('id_armada', '=', $armada[$a]['id_armada'])
          ->get(), true);

        $armada[$a]['trayek'] = $trayek;
      }

      $user['armada'] = $armada;
    } else if ($id_role == 5) //Pemilik Bengkel
    {
      $bengkel = json_decode(DB::table('bengkel')
        ->where('id_user', '=', $user['id_user'])
        ->get(), true);

      $user['bengkel'] = $bengkel;
    } else if ($id_role == 6) //Pemilik Kios BBM
    {
      $kios_bbm = json_decode(DB::table('kios_bbm')
        ->where('id_user', '=', $user['id_user'])
        ->get(), true);

      $user['kios_bbm'] = $kios_bbm;
    } else if ($id_role == 7) //Pemilik Order
    {
      $order = json_decode(DB::table('order')
        ->where('id_user', '=', $user['id_user'])
        ->get(), true);

      $user['order'] = $order;
    } else if ($id_role == 8) //Pemilik Toko Sparepart
    {
      $toko_sparepart = json_decode(DB::table('toko_sparepart')
        ->where('id_user', '=', $user['id_user'])
        ->get(), true);

      for ($a = 0; $a < count($toko_sparepart); $a++) {
        $sparepart = json_decode(DB::table('sparepart')
          ->where('id_toko_sparepart', '=', $toko_sparepart[$a]['id_toko_sparepart'])
          ->get(), true);

        $toko_sparepart[$a]['sparepart'] = $sparepart;
      }

      $user['toko_sparepart'] = $toko_sparepart;
    }

    $ulasan = json_decode(DB::table('ulasan')
      ->where('id_user', '=', $user['id_user'])
      ->get(), true);

    $user['ulasan'] = $ulasan;

    return $user;
  }
}
