<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('media')->insert([
			[
				'user_id'     => 1,
				'type'        => 'photojournalism',
				'title'       => 'Campus Photo of the Year',
				'date'        => now(),
				'tags'        => json_encode(['school', 'award']),
				'description' => 'A winning photo capturing campus life.',
				'image_path'  => 'media/photo1.jpg',
				'link'        => null,
				'remarks'    => null,
				'date_publish' => null,
				'status'     => 'Draft',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'user_id'     => 2,
				'type'        => 'tv_broadcasting',
				'title'       => 'Creativity, strategy, and storytelling were at their finest during the SPJ Festival of Talents as students showcased their skills in the SPJ Ad Making Contest!',
				'date'        => now()->subDays(3),
				'tags'        => json_encode(['broadcast', 'news']),
				'description' => 'From compelling visuals to powerful messages, these young creatives left us in awe with their talent and dedication. 💡🎬

					🌟 Congratulations to our winners! 🌟
					🥇 1st Place – 8-BULLETIN
					🥈 2nd Place – 9-INQUIRER
					🥉 3rd Place – 10-STAR
					👏 4th Place – 7-JOURNAL

					We are beyond proud of all participants who poured their heart and passion into their ads. Your work is an inspiration to the journalism and advertising community. 🙌

					📸 Stay tuned as we showcase their amazing creations soon!',
				'image_path'  => null,
				'link'        => 'https://www.facebook.com/plugins/video.php?height=318&href=https%3A%2F%2Fwww.facebook.com%2Fspjmangaldan%2Fvideos%2F9788808044510658%2F&show_text=false&width=560&t=0',
				'remarks'    => null,
				'date_publish' => null,
				'status'     => 'Draft',
				'created_at'=> now(),
				'updated_at'=> now(),
			],
		]);
	}
}
