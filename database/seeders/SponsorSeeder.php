<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'Nike',
                'logo' => null,
                'website' => 'https://nike.com',
                'tier' => 'platinum',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Adidas',
                'logo' => null,
                'website' => 'https://adidas.com',
                'tier' => 'platinum',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Puma',
                'logo' => null,
                'website' => 'https://puma.com',
                'tier' => 'gold',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Under Armour',
                'logo' => null,
                'website' => 'https://underarmour.com',
                'tier' => 'gold',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'New Balance',
                'logo' => null,
                'website' => 'https://newbalance.com',
                'tier' => 'silver',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Reebok',
                'logo' => null,
                'website' => 'https://reebok.com',
                'tier' => 'silver',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}
