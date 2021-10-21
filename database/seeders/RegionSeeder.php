<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            'Ilocos Region',
            'Cagayan Valley',
            'Central Luzon',
            'CALABARZON',
            'MIMAROPA Region',
            'Bicol Region',
            'Western Visayas',
            'Central Visayas',
            'Eastern Visayas',
            'Zamboanga Peninsula',
            'Northern Mindanao',
            'Davao Region',
            'SOCCSKSARGEN',
            'NCR',
            'CAR',
            'ARMM',
            'Caraga'
        ];
        foreach ($regions as $region) {
            Region::create(['name'=>$region]);
        }
    }
}
