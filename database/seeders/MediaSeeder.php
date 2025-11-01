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
				'user_id'     => 3,
				'title'       => 'Campus Photo of the Year',
				'description' => 'A winning photo capturing campus life.',
				'image_path'  => 'media/photo1.jpg',
				'link'        => null,
				'category'    => 'Photojournalism',
				'tags'        => ['school', 'award'],
				'date_submitted'        => now(),
				'date_publish' => null,
				'status'      => 'Submitted',
				'remarks'     => null,
			],
			[
				'user_id'     => 3,
				'title'       => 'Creativity, strategy, and storytelling were at their finest...',
				'description' => 'From compelling visuals to powerful messages...',
				'image_path'  => null,
				'link'        => 'https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2F61562275457366%2Fvideos%2F417447787991775%2F&show_text=false&width=560&t=0',
				'category'    => 'TV Broadcasting',
				'tags'        => ['broadcast', 'news'],
				'date_submitted'        => now()->subDays(3),
				'date_publish' => null,
				'status'      => 'Submitted',
				'remarks'     => null,
			],

		];

		foreach ($mediaData as $media) {
			Media::create($media);
		}
	}
}
