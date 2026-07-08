<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'first_name' => 'Admin',
            'last_name' => 'FoundIt',
            'email' => 'admin@foundit.test',
        ]);

        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@foundit.test',
        ]);

        Item::factory(8)->create(['user_id' => $user->id]);
        Item::factory(2)->create(['user_id' => $admin->id]);
    }
}
