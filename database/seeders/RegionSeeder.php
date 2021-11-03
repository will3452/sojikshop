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
            'NCR',
            'CAR',
            'Western Visayas',
            'Central Visayas',
            'Eastern Visayas',
            'Zamboanga Peninsula',
            'Northern Mindanao',
            'Davao Region',
            'SOCCSKSARGEN',
            'ARMM',
            'Caraga'
        ];
        $islands = [
            'luzon',
            'visayas',
            'mindanao'
        ];

        $count = 0;
        $islandCount = 0;
        foreach ($regions as $region) {
            $count ++;
            if ($count == 8) {
                $islandCount ++;
            }
            Region::create(['name'=>$region, 'island'=>$islands[$islandCount]]);
        }
    }
}
