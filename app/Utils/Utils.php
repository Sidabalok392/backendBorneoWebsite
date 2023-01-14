<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Utils
{
  public static function PembagiNama($nama_lengkap)
  {
    $nama_lengkap = ucwords($nama_lengkap);
    $pos = strpos($nama_lengkap, ' ', 0);
    $length = strlen($nama_lengkap);

    $nama_depan = trim(substr($nama_lengkap, 0, $pos));
    $nama_belakang = trim(substr($nama_lengkap, $pos, $length - $pos));

    if (empty($pos)) {
      $nama_depan = $nama_belakang;
      $nama_belakang = '';
    }

    return array($nama_depan, $nama_belakang);
  }

  public static function PembagiKode($nama_sparepart, $sparepart)
  {
    $nama_sparepart = Str::upper($nama_sparepart);
    $nama_sparepart = str_replace(' ', '', $nama_sparepart);
    $kode_sparepart =
      substr($nama_sparepart, 0, 1) .
      substr($nama_sparepart, strlen($nama_sparepart) / 2, 1) .
      substr($nama_sparepart, strlen($nama_sparepart) - 1, 1) . '-';

    if ($sparepart->id_sparepart < 10) {
      $kode_sparepart .= '00' . $sparepart->id_sparepart;
    } else if ($sparepart->id_sparepart < 100) {
      $kode_sparepart .= '0' . $sparepart->id_sparepart;
    } else {
      $kode_sparepart .= $sparepart->id_sparepart;
    }

    return $kode_sparepart;
  }
}
