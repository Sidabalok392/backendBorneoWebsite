<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  protected $table = 'order';
  protected $primaryKey = 'id_order';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'status',
    'tanggal_pemesanan',
    'tanggal_konfirmasi',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
