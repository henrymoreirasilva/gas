<?php

use Illuminate\Database\Seeder;

class SaleItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gas\Models\SaleItem::class, 50)->create();
    }
}
