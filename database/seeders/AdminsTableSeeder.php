<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'aaa',
            'login_id' => 'aaa_id',
            'password' => Hash::make('hogehoge'),
        ]);

        Admin::factory()->create([
            'name' => 'bbb',
            'login_id' => 'bbb_id',
            'password' => Hash::make('fugafuga'),
        ]);
    }
}
