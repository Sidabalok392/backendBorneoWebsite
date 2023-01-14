<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
  use HasFactory;

  protected $table = 'bengkel';
  protected $primaryKey = 'id_bengkel';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'nama_bengkel',
    'alamat_bengkel',
    'deskripsi_bengkel',
    'tanggal_berdiri',
    'foto_surat_izin',
    'foto_bengkel',
    'lokasi_bengkel',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
