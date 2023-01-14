<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $table = 'user';
  protected $primaryKey = 'id_user';
  public $timestamps = false;

  protected $fillable = [
    'id_role',
    'nama_depan',
    'nama_belakang',
    'jenis_kelamin',
    'tanggal_lahir',
    'foto_profil',
    'foto_ktp',
    'alamat',
    'nomor_hp',
    'email',
    'password',
  ];

  public function driver()
  {
    return $this->hasOne(Driver::class);
  }

  public function armada()
  {
    return $this->hasMany(Armada::class);
  }

  public function bengkel()
  {
    return $this->hasMany(Bengkel::class);
  }

  public function kios_bbm()
  {
    return $this->hasMany(KiosBBM::class);
  }

  public function order()
  {
    return $this->hasMany(Order::class);
  }

  public function toko_sparepart()
  {
    return $this->hasMany(TokoSparepart::class);
  }

  public function ulasan()
  {
    return $this->hasMany(Ulasan::class);
  }
}
