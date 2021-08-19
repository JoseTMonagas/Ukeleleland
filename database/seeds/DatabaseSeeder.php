<?php

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
    $this->call(ProductsTableSeeder::class);
    $this->call(CommunesRegionsSeeder::class);
    $this->call(DispatchPricesTableSeeder::class);
    $this->call(ProfilesTableSeeder::class);
    $this->call(CouponsTableSeeder::class);
  }
}
