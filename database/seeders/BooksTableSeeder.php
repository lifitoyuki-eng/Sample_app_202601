<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            Category::factory()->create(['title' => 'programming']),
            Category::factory()->create(['title' => 'disign']),
            Category::factory()->create(['title' => 'management']),
        ];

        foreach ($categories as $category)
        {
            //カテゴリ1件につき2件の書籍を登録する
            //ファクトリで生成されるカテゴリIdを上書きする
            Book::factory(2)->create(['category_id' => $category->id]);
        }
    }
}
