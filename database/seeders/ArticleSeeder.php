<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleData = [
            [
                'user_id' => 3,
                'title' => 'The Rise of Student Journalism',
                'description' => 'In recent years, student journalism has seen a significant rise...',
                'image_path' => 'articles/article_2025-10-02_2.png',
                'category' => 'News',
                'tags' => ['student', 'journalism'],
                'date_submitted' => now(),
                'date_publish' => null,
                'status' => 'Submitted',
                'remarks' => null,
            ],
            [
                'user_id' => 3,
                'title' => 'Exploring the World of Digital Media',
                'description' => 'Digital media is transforming the way we consume information...',
                'image_path' => 'articles/article_2025-10-02_1.png',
                'category' => 'News',
                'tags' => ['digital', 'media'],
                'date_submitted' => now()->subDays(5),
                'date_publish' => null,
                'status' => 'Submitted',
                'remarks' => null,
            ],
        ];

        foreach ($articleData as $article) {
            Article::create($article);
        }
    }
}
