<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;
use App\Models\News;
use App\Models\Fixture;
use App\Models\Sponsor;
use App\Models\GalleryImage;
use App\Models\OfficeBearer;
use App\Models\MemberApplication;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;

class ResetDatabaseWithSamples extends Command
{
    protected $signature = 'db:reset-with-samples {--force : Force the operation without confirmation}';
    protected $description = 'Reset database with sample data (keeps settings)';

    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('This will delete ALL data except settings. Are you sure?')) {
                $this->info('Operation cancelled.');
                return;
            }
        }

        $this->info('Starting database reset with sample data...');

        try {
            // Clear all data except settings
            $this->clearDataExceptSettings();
            
            // Generate sample data
            $this->generateSampleData();
            
            $this->info('Database reset completed successfully!');
            $this->info('Sample data has been added to all tables.');
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }

    private function clearDataExceptSettings()
    {
        $this->info('Clearing existing data...');
        
        // Clear all tables except settings
        DB::table('sliders')->truncate();
        DB::table('news')->truncate();
        DB::table('fixtures')->truncate();
        DB::table('sponsors')->truncate();
        DB::table('gallery_images')->truncate();
        DB::table('office_bearers')->truncate();
        DB::table('member_applications')->truncate();
        DB::table('products')->truncate();
        
        $this->info('✓ Data cleared (settings preserved)');
    }

    private function generateSampleData()
    {
        $this->info('Generating sample data...');
        
        // Generate Sliders
        $this->generateSliders();
        
        // Generate News
        $this->generateNews();
        
        // Generate Fixtures
        $this->generateFixtures();
        
        // Generate Sponsors
        $this->generateSponsors();
        
        // Generate Gallery Images
        $this->generateGalleryImages();
        
        // Generate Office Bearers
        $this->generateOfficeBearers();
        
        // Generate Member Applications
        $this->generateMemberApplications();
        
        // Generate Products
        $this->generateProducts();
        
        $this->info('✓ Sample data generated successfully');
    }

    private function generateSliders()
    {
        $sliders = [
            [
                'title' => 'Welcome to YSSC Football Club',
                'description' => 'Building champions of tomorrow since 1967',
                'button_text' => 'Join Us',
                'button_link' => '/join-us',
                'image' => 'sliders/slider1.jpg',
                'is_active' => true,
                'order' => 1
            ],
            [
                'title' => 'Excellence in Football',
                'description' => 'Training the next generation of football stars',
                'button_text' => 'Learn More',
                'button_link' => '/about',
                'image' => 'sliders/slider2.jpg',
                'is_active' => true,
                'order' => 2
            ],
            [
                'title' => 'Community & Sports',
                'description' => 'Bringing together passion and excellence',
                'button_text' => 'Get Involved',
                'button_link' => '/contact',
                'image' => 'sliders/slider3.jpg',
                'is_active' => true,
                'order' => 3
            ]
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
        
        $this->info('✓ Generated 3 sliders');
    }

    private function generateNews()
    {
        $newsArticles = [
            [
                'title' => 'YSSC Wins Championship 2024',
                'slug' => 'yssc-wins-championship-2024',
                'excerpt' => 'Our team has achieved a remarkable victory in the national championship.',
                'content' => 'The Young Silver Sports Club has once again proven its excellence by winning the National Football Championship 2024. This victory represents years of dedication, hard work, and commitment from our players, coaches, and supporters.',
                'featured_image' => 'news/championship.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(2)
            ],
            [
                'title' => 'New Training Facilities Opened',
                'slug' => 'new-training-facilities-opened',
                'excerpt' => 'State-of-the-art training facilities now available for our players.',
                'content' => 'We are excited to announce the opening of our new training facilities. These modern facilities include a full-size football pitch, gymnasium, and recovery center.',
                'featured_image' => 'news/facilities.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(5)
            ],
            [
                'title' => 'Youth Development Program Launch',
                'slug' => 'youth-development-program-launch',
                'excerpt' => 'New program to nurture young football talent in our community.',
                'content' => 'Our Youth Development Program is designed to identify and nurture young football talent. This comprehensive program includes technical training, physical development, and character building.',
                'featured_image' => 'news/youth-program.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(7)
            ],
            [
                'title' => 'Community Outreach Initiative',
                'slug' => 'community-outreach-initiative',
                'excerpt' => 'YSSC extends support to local communities through various programs.',
                'content' => 'As part of our commitment to community development, we have launched several outreach programs including free coaching sessions and equipment donations.',
                'featured_image' => 'news/community.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(10)
            ],
            [
                'title' => 'Annual General Meeting 2024',
                'slug' => 'annual-general-meeting-2024',
                'excerpt' => 'Join us for our Annual General Meeting to discuss club progress.',
                'content' => 'All members are invited to attend our Annual General Meeting where we will review the past year\'s achievements and plan for the future.',
                'featured_image' => 'news/agm.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(14)
            ],
            [
                'title' => 'International Tournament Participation',
                'slug' => 'international-tournament-participation',
                'excerpt' => 'YSSC to represent Sri Lanka in upcoming international tournament.',
                'content' => 'We are proud to announce that YSSC will represent Sri Lanka in the upcoming South Asian Football Championship.',
                'featured_image' => 'news/international.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(18)
            ],
            [
                'title' => 'Coaching Staff Expansion',
                'slug' => 'coaching-staff-expansion',
                'excerpt' => 'New qualified coaches join our training team.',
                'content' => 'We have expanded our coaching staff with internationally certified coaches to provide the best training for our players.',
                'featured_image' => 'news/coaches.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(21)
            ],
            [
                'title' => 'Equipment Upgrade Program',
                'slug' => 'equipment-upgrade-program',
                'excerpt' => 'New training equipment and gear for all players.',
                'content' => 'Thanks to our sponsors, we have upgraded all training equipment to provide our players with the best resources for development.',
                'featured_image' => 'news/equipment.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(25)
            ],
            [
                'title' => 'Women\'s Team Formation',
                'slug' => 'womens-team-formation',
                'excerpt' => 'YSSC launches its first women\'s football team.',
                'content' => 'We are excited to announce the formation of our first women\'s football team, promoting gender equality in sports.',
                'featured_image' => 'news/womens-team.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(28)
            ],
            [
                'title' => 'Partnership with Local Schools',
                'slug' => 'partnership-local-schools',
                'excerpt' => 'Collaboration with local schools to promote football.',
                'content' => 'We have partnered with local schools to introduce football programs and identify young talent in our community.',
                'featured_image' => 'news/schools.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(32)
            ],
            [
                'title' => 'Health and Fitness Program',
                'slug' => 'health-fitness-program',
                'excerpt' => 'New health and fitness program for all members.',
                'content' => 'Our new health and fitness program focuses on overall wellness, including nutrition guidance and injury prevention.',
                'featured_image' => 'news/health.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(35)
            ],
            [
                'title' => 'Technology Integration',
                'slug' => 'technology-integration',
                'excerpt' => 'Modern technology to enhance training and performance.',
                'content' => 'We have integrated modern technology including performance tracking and video analysis to improve our training methods.',
                'featured_image' => 'news/technology.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(40)
            ]
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
        
        $this->info('✓ Generated 12 news articles');
    }

    private function generateFixtures()
    {
        $fixtures = [
            [
                'home_team' => 'YSSC',
                'away_team' => 'Colombo FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(3),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Negombo FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(7),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'Kandy FC',
                'away_team' => 'YSSC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(10),
                'venue' => 'Kandy Stadium',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Jaffna FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(14),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'Galle FC',
                'away_team' => 'YSSC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(17),
                'venue' => 'Galle Stadium',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Ratnapura FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(21),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'Anuradhapura FC',
                'away_team' => 'YSSC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(24),
                'venue' => 'Anuradhapura Stadium',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Batticaloa FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(28),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'Trincomalee FC',
                'away_team' => 'YSSC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(31),
                'venue' => 'Trincomalee Stadium',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Kurunegala FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(35),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'Matara FC',
                'away_team' => 'YSSC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(38),
                'venue' => 'Matara Stadium',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Badulla FC',
                'competition' => 'Premier League',
                'match_date' => now()->addDays(42),
                'venue' => 'Cooray Park',
                'status' => 'scheduled'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Colombo FC',
                'competition' => 'Premier League',
                'match_date' => now()->subDays(3),
                'venue' => 'Cooray Park',
                'home_score' => 2,
                'away_score' => 1,
                'status' => 'finished'
            ],
            [
                'home_team' => 'Negombo FC',
                'away_team' => 'YSSC',
                'competition' => 'Premier League',
                'match_date' => now()->subDays(7),
                'venue' => 'Negombo Stadium',
                'home_score' => 0,
                'away_score' => 3,
                'status' => 'finished'
            ],
            [
                'home_team' => 'YSSC',
                'away_team' => 'Kandy FC',
                'competition' => 'Premier League',
                'match_date' => now()->subDays(10),
                'venue' => 'Cooray Park',
                'home_score' => 1,
                'away_score' => 1,
                'status' => 'finished'
            ]
        ];

        foreach ($fixtures as $fixture) {
            Fixture::create($fixture);
        }
        
        $this->info('✓ Generated 15 fixtures');
    }

    private function generateSponsors()
    {
        $sponsors = [
            ['name' => 'Coca-Cola', 'logo' => 'sponsors/coca-cola.png', 'website' => 'https://coca-cola.com', 'is_active' => true, 'order' => 1],
            ['name' => 'Nike', 'logo' => 'sponsors/nike.png', 'website' => 'https://nike.com', 'is_active' => true, 'order' => 2],
            ['name' => 'Adidas', 'logo' => 'sponsors/adidas.png', 'website' => 'https://adidas.com', 'is_active' => true, 'order' => 3],
            ['name' => 'Pepsi', 'logo' => 'sponsors/pepsi.png', 'website' => 'https://pepsi.com', 'is_active' => true, 'order' => 4],
            ['name' => 'Samsung', 'logo' => 'sponsors/samsung.png', 'website' => 'https://samsung.com', 'is_active' => true, 'order' => 5],
            ['name' => 'Apple', 'logo' => 'sponsors/apple.png', 'website' => 'https://apple.com', 'is_active' => true, 'order' => 6],
            ['name' => 'Microsoft', 'logo' => 'sponsors/microsoft.png', 'website' => 'https://microsoft.com', 'is_active' => true, 'order' => 7],
            ['name' => 'Google', 'logo' => 'sponsors/google.png', 'website' => 'https://google.com', 'is_active' => true, 'order' => 8],
            ['name' => 'Facebook', 'logo' => 'sponsors/facebook.png', 'website' => 'https://facebook.com', 'is_active' => true, 'order' => 9],
            ['name' => 'Twitter', 'logo' => 'sponsors/twitter.png', 'website' => 'https://twitter.com', 'is_active' => true, 'order' => 10],
            ['name' => 'Instagram', 'logo' => 'sponsors/instagram.png', 'website' => 'https://instagram.com', 'is_active' => true, 'order' => 11],
            ['name' => 'LinkedIn', 'logo' => 'sponsors/linkedin.png', 'website' => 'https://linkedin.com', 'is_active' => true, 'order' => 12]
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
        
        $this->info('✓ Generated 12 sponsors');
    }

    private function generateGalleryImages()
    {
        $categories = ['Training Sessions', 'Matches', 'Events', 'Team Photos', 'Awards', 'Community'];
        
        for ($i = 1; $i <= 15; $i++) {
            $category = $categories[array_rand($categories)];
            GalleryImage::create([
                'title' => "Gallery Image {$i}",
                'description' => "Description for gallery image {$i}",
                'image_path' => "gallery/gallery-{$i}.jpg",
                'category' => $category,
                'order' => $i,
                'is_featured' => $i <= 5
            ]);
        }
        
        $this->info('✓ Generated 15 gallery images');
    }

    private function generateOfficeBearers()
    {
        $categories = [
            'Executive Committee' => ['President', 'Vice President', 'Secretary', 'Treasurer'],
            'Committee Members' => ['Committee Member', 'Executive Committee Member'],
            'Sports Management' => ['Team Manager', 'Head Coach', 'Assistant Coach'],
            'Administration' => ['Public Relations Officer', 'Media Coordinator'],
            'Advisors' => ['Chief Patron', 'Patron', 'Advisor']
        ];

        $names = [
            'John Silva', 'Maria Fernando', 'David Perera', 'Sarah Rajapaksa',
            'Michael Jayawardena', 'Lisa Wickramasinghe', 'Robert Mendis',
            'Jennifer Karunaratne', 'William Senanayake', 'Amanda Bandaranaike',
            'Christopher Wijeratne', 'Rachel Dias', 'James Rodrigo', 'Michelle Fonseka',
            'Andrew Peiris', 'Nicole Goonetilleke', 'Daniel Abeygunawardena',
            'Stephanie Ratnayake', 'Mark Jayasuriya', 'Victoria Kulatunga'
        ];

        $order = 1;
        foreach ($categories as $category => $positions) {
            foreach ($positions as $position) {
                $name = $names[array_rand($names)];
                OfficeBearer::create([
                    'name' => $name,
                    'category' => $category,
                    'position' => $position,
                    'email' => strtolower(str_replace(' ', '.', $name)) . '@yssc.com',
                    'phone' => '0' . rand(70, 77) . rand(100000, 999999),
                    'bio' => "Experienced professional with extensive knowledge in {$category}.",
                    'order' => $order++
                ]);
            }
        }
        
        $this->info('✓ Generated office bearers for all categories');
    }

    private function generateMemberApplications()
    {
        $names = [
            'Kumar Silva', 'Priya Fernando', 'Rajesh Perera', 'Nimali Jayawardena',
            'Samantha Wickramasinghe', 'Dilshan Mendis', 'Chamari Karunaratne',
            'Tharindu Senanayake', 'Kavindu Bandaranaike', 'Sanduni Wijeratne',
            'Lakshan Dias', 'Nethmi Rodrigo', 'Dhanushka Fonseka', 'Ishara Peiris',
            'Tharaka Goonetilleke', 'Dilani Abeygunawardena', 'Kavishka Ratnayake',
            'Sachini Jayasuriya', 'Dilhara Kulatunga', 'Nipuni Rathnayake'
        ];

        for ($i = 1; $i <= 15; $i++) {
            $name = $names[array_rand($names)];
            $year = date('Y');
            $referenceNumber = "YSSC/{$year}/" . str_pad($i, 4, '0', STR_PAD_LEFT);
            
            MemberApplication::create([
                'reference_number' => $referenceNumber,
                'full_name' => $name,
                'address' => "123 Main Street, Colombo 0{$i}",
                'contact_number_1' => '0' . rand(70, 77) . rand(100000, 999999),
                'contact_number_2' => '0' . rand(70, 77) . rand(100000, 999999),
                'email' => strtolower(str_replace(' ', '.', $name)) . '@gmail.com',
                'nic' => rand(100000000, 999999999) . 'V',
                'guardian_name' => 'Guardian ' . $name,
                'guardian_address' => "456 Guardian Street, Colombo 0{$i}",
                'guardian_contact_1' => '0' . rand(70, 77) . rand(100000, 999999),
                'guardian_contact_2' => '0' . rand(70, 77) . rand(100000, 999999),
                'guardian_nic' => rand(100000000, 999999999) . 'X',
                'profile_photo' => "member-photos/member-{$i}.jpg",
                'status' => 'pending'
            ]);
        }
        
        $this->info('✓ Generated 15 member applications');
    }

    private function generateProducts()
    {
        $products = [
            [
                'name' => 'YSSC Official Jersey',
                'description' => 'Official team jersey with club logo and colors',
                'price' => 2500.00,
                'image' => 'products/jersey.jpg',
                'is_active' => true
            ],
            [
                'name' => 'YSSC Training Kit',
                'description' => 'Complete training kit for practice sessions',
                'price' => 1800.00,
                'image' => 'products/training-kit.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Club Scarf',
                'description' => 'Official club scarf for supporters',
                'price' => 800.00,
                'image' => 'products/scarf.jpg',
                'is_active' => true
            ],
            [
                'name' => 'YSSC Cap',
                'description' => 'Official club cap with logo',
                'price' => 600.00,
                'image' => 'products/cap.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Team Badge',
                'description' => 'Official team badge for collection',
                'price' => 300.00,
                'image' => 'products/badge.jpg',
                'is_active' => true
            ],
            [
                'name' => 'YSSC Keychain',
                'description' => 'Club keychain with logo',
                'price' => 200.00,
                'image' => 'products/keychain.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Training Ball',
                'description' => 'Official training football',
                'price' => 1200.00,
                'image' => 'products/ball.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Club Mug',
                'description' => 'Official club mug with logo',
                'price' => 400.00,
                'image' => 'products/mug.jpg',
                'is_active' => true
            ],
            [
                'name' => 'YSSC T-Shirt',
                'description' => 'Official club t-shirt',
                'price' => 1000.00,
                'image' => 'products/tshirt.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Club Sticker Pack',
                'description' => 'Set of club stickers',
                'price' => 150.00,
                'image' => 'products/stickers.jpg',
                'is_active' => true
            ],
            [
                'name' => 'YSSC Hoodie',
                'description' => 'Official club hoodie',
                'price' => 3500.00,
                'image' => 'products/hoodie.jpg',
                'is_active' => true
            ],
            [
                'name' => 'Training Shorts',
                'description' => 'Official training shorts',
                'price' => 1200.00,
                'image' => 'products/shorts.jpg',
                'is_active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        
        $this->info('✓ Generated 12 products');
    }
}