<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gas\Models\User::class, 5)->create();
        factory(Gas\Models\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com.br',
            'password' => bcrypt(123456),
            'role' => 'admin',
            'situation' => 'ativo',
            'remember_token' => str_random(10)
        ]);
        factory(Gas\Models\User::class)->create([
            'name' => 'user',
            'email' => 'user@user.com.br',
            'password' => bcrypt(123456),
            'role' => 'user',
            'branch_id' => 1,
            'situation' => 'ativo',
            'remember_token' => str_random(10)
        ]);
    }
}
