<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class UlasanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('ulasan')->insert([
      'id_user' => 3,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 4,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 3,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 5,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 4,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 4,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 5,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 5,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 5,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 4,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 5,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 3,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 6,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 4,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 6,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 4,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 7,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 5,
    ]);
    DB::table('ulasan')->insert([
      'id_user' => 8,
      'ulasan' => "Ulasan Ulasan",
      'rating' => 4,
    ]);
  }
}
