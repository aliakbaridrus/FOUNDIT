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
        $admin = User::updateOrCreate(
            ['email' => 'admin@foundit.test'],
            [
                'first_name' => 'Admin',
                'last_name' => 'FoundIt',
                'whatsapp' => '087820199533',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'user@foundit.test'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'whatsapp' => '081234567890',
                'role' => 'user',
                'password' => bcrypt('password'),
            ]
        );

        if (Item::count() > 0) {
            return;
        }

        $items = [
            [
                'user_id' => $user->id,
                'title' => 'Lost Black Wallet',
                'category' => 'Accessories',
                'status' => 'Lost',
                'description' => 'Black wallet lost near the campus parking area.',
                'location' => 'Campus Parking',
                'image' => 'https://picsum.photos/seed/wallet/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Found Keys Set',
                'category' => 'Keys',
                'status' => 'Found',
                'description' => 'A set of keys found near the front gate.',
                'location' => 'Front Gate',
                'image' => 'https://picsum.photos/seed/keys/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Lost Student ID',
                'category' => 'Documents',
                'status' => 'Lost',
                'description' => 'Student ID card misplaced after class.',
                'location' => 'Lecture Hall A',
                'image' => 'https://picsum.photos/seed/idcard/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Found Earbuds',
                'category' => 'Electronics',
                'status' => 'Found',
                'description' => 'White earbuds found on a bench.',
                'location' => 'Library Bench',
                'image' => 'https://picsum.photos/seed/earbuds/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Lost Glasses',
                'category' => 'Accessories',
                'status' => 'Lost',
                'description' => 'Prescription glasses with black frame.',
                'location' => 'Cafeteria',
                'image' => 'https://picsum.photos/seed/glasses/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Found Umbrella',
                'category' => 'Other',
                'status' => 'Found',
                'description' => 'Foldable blue umbrella found after rain.',
                'location' => 'Lobby',
                'image' => 'https://picsum.photos/seed/umbrella/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Lost Power Bank',
                'category' => 'Electronics',
                'status' => 'Lost',
                'description' => 'Black power bank with a short cable.',
                'location' => 'Computer Lab',
                'image' => 'https://picsum.photos/seed/powerbank/640/480',
            ],
            [
                'user_id' => $user->id,
                'title' => 'Found Notebook',
                'category' => 'Documents',
                'status' => 'Found',
                'description' => 'Blue notebook with class notes.',
                'location' => 'Student Lounge',
                'image' => 'https://picsum.photos/seed/notebook/640/480',
            ],
            [
                'user_id' => $admin->id,
                'title' => 'Lost Headset',
                'category' => 'Electronics',
                'status' => 'Lost',
                'description' => 'Over-ear headset left after meeting.',
                'location' => 'Meeting Room',
                'image' => 'https://picsum.photos/seed/headset/640/480',
            ],
            [
                'user_id' => $admin->id,
                'title' => 'Found Charger',
                'category' => 'Electronics',
                'status' => 'Found',
                'description' => 'USB charger found near the charger station.',
                'location' => 'Charging Station',
                'image' => 'https://picsum.photos/seed/charger/640/480',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
