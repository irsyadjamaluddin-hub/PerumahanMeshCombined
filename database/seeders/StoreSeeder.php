<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Store::count()) {

            DB::table('stores')->insert([

                [
                    'name' => '1st Floor',
                ],
                [
                    'name' => '4th Floor',
                ],
            
            ]);

        }
        
    }
}
