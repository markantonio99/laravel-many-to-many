<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creiamo un'istanza di Faker
        $faker = Faker::create();

        // Creiamo 50 eventi fittizi
        for ($i = 0; $i < 50; $i++) {
            // Creiamo un nuovo evento con i dati di prova
            Event::create([
                'title' => $faker->sentence,
                'location' => 'New York', // Valore di default
                'description' => $faker->paragraph,
                'slug' => $faker->slug
            ]);
        }
    }
}
