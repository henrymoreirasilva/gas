<?php

use Illuminate\Database\Seeder;

class SallerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gas\Models\Seller::class, 10)->create();
    }
}
