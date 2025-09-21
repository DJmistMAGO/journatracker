<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'user_id'     => 1,
                'title_article' => 'The Rise of Student Journalism',
                'date_written' => now(),
                'category'    => 'Education',
                'tags'        => json_encode(['student', 'journalism']),
                'article_content' => 'In recent years, student journalism has seen a significant rise...',
                'thumbnail_image' => 'thumbnails/article_2025-09-21_1.jpg',
				'date_publish' => null,
				'remarks' => null,
				'created_at' => now(),
				'updated_at' => now(),
            ],
            [
                'user_id'     => 1,
                'title_article' => 'Exploring the World of Digital Media',
                'date_written' => now()->subDays(5),
                'category'    => 'Media',
                'tags'        => json_encode(['digital', 'media']),
                'article_content' => 'Digital media is transforming the way we consume information...',
                'thumbnail_image' => 'thumbnails/article_2025-09-21_1.jpg', 
				'date_publish' => null,
				'remarks' => null,
				'created_at' => now()->subDays(3),
				'updated_at' => now()->subDays(3),
            ],
        ]);
    }
}
