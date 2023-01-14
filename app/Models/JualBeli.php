<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JualBeli extends Model
{
  use HasFactory;

  protected $table = 'jual_beli';
  protected $primaryKey = 'id_jual_beli';
  public $timestamps = false;

  protected $fillable = [
    'merk',
    'tipe',
    'tahun',
    'foto_mobil',
    'pemilik',
    'lokasi',
    'kapasitas_mesin',
    'tanggal_inspeksi',
    'riwayat',
    'jenis_bahan_bakar',
    'jenis_transmisi',
    'pajak_berlaku_hingga',
    'harga',
  ];
}
