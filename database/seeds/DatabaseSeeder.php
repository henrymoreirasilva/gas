<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(SallerTableSeeder::class);
        $this->call(SaleTableSeeder::class);
        $this->call(SaleItemTableSeeder::class);
        

        Model::reguard();
    }
}
