<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $stores = [
            ['name' => 'Main Warehouse', 'code' => 'MW'],
            ['name' => 'Flipkart', 'code' => 'BS1'],
            ['name' => 'Amazon', 'code' => 'BS2'],
            ['name' => 'Ebay', 'code' => 'OS'],
            ['name' => 'Alibaba', 'code' => 'ODC'],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
