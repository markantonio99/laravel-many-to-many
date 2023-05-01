<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Hard House', 'Hip-Hop', 'Commerciale', 'Reggaeton', 'Techno'];

        foreach ($categories as $category_name) {
            $new_cat = new Category();
            $new_cat->name = $category_name;
            $new_cat->slug = Str::slug($category_name);

            $new_cat->save(); 
        }
    }
}
