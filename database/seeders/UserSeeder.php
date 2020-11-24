<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::factory(1)->create([
            'email' => 'noel@natal.com'
        ]);
    }
}
