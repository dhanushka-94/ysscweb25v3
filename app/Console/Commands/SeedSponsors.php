<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sponsor;

class SeedSponsors extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'seed:sponsors';

    /**
     * The console command description.
     */
    protected $description = 'Seed sponsors for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding sponsors...');

        // Clear existing sponsors
        Sponsor::truncate();

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
            $this->line("Created sponsor: {$sponsor['name']}");
        }

        $this->info('Sponsors seeded successfully!');
        $this->info('Total sponsors: ' . Sponsor::count());
    }
}
