<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
  use HasFactory;

  protected $table = 'driver';
  protected $primaryKey = 'id_driver';
  public $timestamps = false;

  protected $fillable = [
    'id_user',
    'pengalaman',
    'foto_sim',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
