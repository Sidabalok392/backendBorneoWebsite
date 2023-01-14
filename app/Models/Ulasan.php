<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
  use HasFactory;

  protected $table = 'ulasan';
  protected $primaryKey = 'id_ulasan';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'ulasan',
    'rating',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
