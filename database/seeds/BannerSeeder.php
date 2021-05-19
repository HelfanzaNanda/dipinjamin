<?php

use App\Banner;
use App\Media;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = Banner::create();
		for ($i=1; $i <= 4; $i++) { 
			Media::create([
				'model_type' => Banner::class,
				'model_id' => $banner->id,
				'filename' => 'uploads/banners/'.'banner '.$i.'.jpg'
			]);
		}
    }
}
