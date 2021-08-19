<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Product::create([
      'name' => 'Test 1',
      'slug' => 'Test-1',
      'details' => 'Test Details',
      'stock' => 12,
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 2',
      'slug' => 'Test-2',
      'details' => 'Test Details',
      'stock' => 12,
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 3',
      'slug' => 'Test-3',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 4',
      'slug' => 'Test-4',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 5',
      'slug' => 'Test-5',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 6',
      'slug' => 'Test-6',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 7',
      'slug' => 'Test-7',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 8',
      'slug' => 'Test-8',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 9',
      'slug' => 'Test-9',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 10',
      'slug' => 'Test-10',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 11',
      'slug' => 'Test-11',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999,250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
    Product::create([
      'name' => 'Test 12',
      'slug' => 'Test-12',
      'stock' => 12,
      'details' => 'Test Details',
      'price' => rand(14999, 250999),
      'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                        vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    ]);
  }
}
