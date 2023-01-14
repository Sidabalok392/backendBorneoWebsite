<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KiosBBM extends Model
{
  use HasFactory;

  protected $table = 'kios_bbm';
  protected $primaryKey = 'id_kios_bbm';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'nama_kios_bbm',
    'alamat_kios_bbm',
    'deskripsi_kios_bbm',
    'tanggal_berdiri',
    'foto_surat_izin',
    'foto_kios_bbm',
    'lokasi_kios_bbm',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
