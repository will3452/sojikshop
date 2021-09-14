<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'email' => 'superadmin@sojikshop.store',
            'password' => bcrypt('password'),
            'name' => 'store owner',
        ]);
    }
}
