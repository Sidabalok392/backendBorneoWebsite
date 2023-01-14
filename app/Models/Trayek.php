<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trayek extends Model
{
  use HasFactory;

  protected $table = 'trayek';
  protected $primaryKey = 'id_trayek';
  public $timestamps = false;

  protected $fillable = [
    'id_armada',
    'jarak_tempuh',
    'waktu_tempuh',
    'jenis_muatan',
    'konsumsi_bahan_bakar',
    'uang_perjalanan',
  ];

  public function armada()
  {
    return $this->belongsTo(Armada::class);
  }
}
