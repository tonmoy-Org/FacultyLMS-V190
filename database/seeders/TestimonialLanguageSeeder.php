<?php

namespace Database\Seeders;

use App\Models\TestimonialLanguage;
use Illuminate\Database\Seeder;

class TestimonialLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestimonialLanguage::create([
            'testimonial_id' => 1,
            'lang'           => 'en',
            'name'           => 'Natasha Hope',
            'description'    => "We're loving it. This platform is both perfect and highly adaptable to our needs.",
        ]);
        TestimonialLanguage::create([
            'testimonial_id' => 2,
            'lang'           => 'en',
            'name'           => 'Charles Dale',
            'description'    => "An incredible learning experience with great instructors and well-structured courses.",
        ]);
    }
}
