<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokoSparepart extends Model
{
  use HasFactory;

  protected $table = 'toko_sparepart';
  protected $primaryKey = 'id_toko_sparepart';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'nama_toko_sparepart',
    'alamat_toko_sparepart',
    'deskripsi_toko_sparepart',
    'tanggal_berdiri',
    'foto_surat_izin',
    'foto_toko_sparepart',
    'lokasi_toko_sparepart',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
