<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Media;
use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishScheduledArticles extends Command
{
    protected $signature = 'content:publish-scheduled';
    protected $description = 'Publish all scheduled articles and media whose publish_at time has arrived';

    public function handle()
    {
        $now = Carbon::now();

        // ✅ Publish Scheduled Articles
        $articles = Article::where('status', 'Scheduled')
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', $now)
            ->get();

        Log::info("Found {$articles->count()} scheduled articles to publish at {$now}");

        foreach ($articles as $article) {
            $article->status = 'Published';
            $article->date_publish = $now;
            $article->save();

            $this->info("📄 Published Article: {$article->title} (ID: {$article->id})");
            Log::info("📄 Published Article: {$article->title} (ID: {$article->id}) at {$now}");
        }

        // ✅ Publish Scheduled Media
        $mediaItems = Media::where('status', 'Scheduled')
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', $now)
            ->get();
        Log::info("Found {$mediaItems->count()} scheduled media items to publish at {$now}");
        foreach ($mediaItems as $media) {
            $media->status = 'Published';
            $media->date_publish = $now;
            $media->save();
            $this->info("🖼️ Published Media: {$media->filename} (ID: {$media->id})");
            Log::info("🖼️ Published Media: {$media->filename} (ID: {$media->id}) at {$now}");
        }

        Log::info('Scheduler ran at ' . now());

        return Command::SUCCESS;
    }
}
