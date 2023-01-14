<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
  use HasFactory;

  protected $table = 'armada';
  protected $primaryKey = 'id_armada';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'jenis_kendaraan',
    'merk_kendaraan',
    'plat_nomor',
    'nomor_mesin',
    'kondisi_mesin',
    'kondisi_ban',
    'kondisi_mobil',
    'batas_muatan',
    'tanggal_beli',
    'foto_armada',
    'status',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function trayek()
  {
    return $this->hasMany(Trayek::class);
  }
}
