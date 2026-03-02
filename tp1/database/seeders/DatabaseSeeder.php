<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rental;
use App\Models\Review;
use App\Models\Sport;
use App\Models\Equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            CategorySeeder::class,
            EquipmentSeeder::class,
            SportSeeder::class,
            EquipmentSportSeeder::class,
        ]);

        Sport::factory(10)->hasAttached(Equipment::factory(2))->create();
        User::factory(10)->has(Rental::factory(3)->has(Review::factory(4)))->create();
    }
}
