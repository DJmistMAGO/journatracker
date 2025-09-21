<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Media;

class MediaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$mediaData = [
			[
				'user_id'     => 1,
				'type'        => 'photojournalism',
				'title'       => 'Campus Photo of the Year',
				'date'        => now(),
				'tags'        => json_encode(['school', 'award']),
				'description' => 'A winning photo capturing campus life.',
				'image_path'  => 'media/photo1.jpg',
				'link'        => null,
				'remarks'     => null,
				'date_publish' => null,
				'status'      => 'Draft',
			],
			[
				'user_id'     => 1,
				'type'        => 'tv_broadcasting',
				'title'       => 'Creativity, strategy, and storytelling were at their finest...',
				'date'        => now()->subDays(3),
				'tags'        => json_encode(['broadcast', 'news']),
				'description' => 'From compelling visuals to powerful messages...',
				'image_path'  => null,
				'link'        => 'https://www.facebook.com/plugins/video.php?...',
				'remarks'     => null,
				'date_publish' => null,
				'status'      => 'Draft',
			],
		];

		foreach ($mediaData as $media) {
			Media::create($media);
		}
	}
}
