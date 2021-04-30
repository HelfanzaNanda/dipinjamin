<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Horor', 'Fantasi', 'Sci-Fi', 'Romance', 'Humor', 'Misteri', 'Petualangan',
        'Biografi', 'Ensiklopedia', 'Jurnal', 'Kamus', 'Filsafat'];
        foreach ($categories as $key => $category) {
            Category::create([
                'category' => $categories[$key]
            ]);
        }
    }
}
