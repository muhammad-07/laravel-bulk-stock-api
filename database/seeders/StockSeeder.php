<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Store;
use Faker\Factory as Faker;

class StockSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $stores = Store::pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Stock::create([
                'item_code' => strtoupper($faker->lexify('ITEM-????')),
                'item_name' => $faker->words(3, true),
                'quantity' => $faker->numberBetween(5, 100),
                'location' => $faker->randomElement(['A1', 'B2', 'C3', 'R1', 'Shelf-5']),
                'store_id' => $faker->randomElement($stores),
                'in_stock_date' => $faker->dateTimeBetween('-7 days', '+5 days')->format('Y-m-d'),
                'status' => 'pending'
            ]);
        }
    }
}
