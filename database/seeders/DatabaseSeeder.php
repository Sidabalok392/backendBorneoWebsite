<?php

namespace Database\Seeders;

use App\Models\JualBeli;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(
      [
        RoleSeeder::class,
        UserSeeder::class,
        DriverSeeder::class,
        ArmadaSeeder::class,
        BengkelSeeder::class,
        KiosBBMSeeder::class,
        OrderSeeder::class,
        TokoSparepartSeeder::class,
        UlasanSeeder::class,
        TrayekSeeder::class,
        SparepartSeeder::class,
        JualBeliSeeder::class,
      ]
    );
  }
}
