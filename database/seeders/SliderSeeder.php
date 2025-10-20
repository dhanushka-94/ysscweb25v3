<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::create([
            'title' => 'Welcome to YSSC Football Club',
            'description' => 'Where passion meets excellence. Join us on our journey to greatness.',
            'image' => 'images/sliders/slider1.jpg',
            'button_text' => 'Learn More',
            'button_link' => '/about/club',
            'order' => 1,
            'is_active' => true,
        ]);
    }
}
