<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
  use HasFactory;

  protected $table = 'sparepart';
  protected $primaryKey = 'id_sparepart';
  public $timestamps = false;

  protected $fillable = [
    'id_toko_sparepart',
    'kode_sparepart',
    'nama_sparepart',
    'harga_sparepart',
    'jumlah_unit',
    'foto_sparepart',
  ];

  public function toko_sparepart()
  {
    return $this->belongsTo(TokoSparepart::class);
  }
}
