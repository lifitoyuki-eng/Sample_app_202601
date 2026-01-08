<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //シーディングの対象指定
        $this->call(CategoriesTableSeeder::class);
        $this->call(AuthorTableSeeder::class);

        $this->call([
            AuthorTableSeeder::class,
            BooksTableSeeder::class,
            AuthorBookTableSeeder::class,
        ]);
    }
}
