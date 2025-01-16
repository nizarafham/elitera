<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'name' => 'Development Bootcamp',
            'description' => 'Full-stack web development in 30 days.',
            'sub_description' => 'Learn the fundamentals of web development, from HTML, CSS, JavaScript, to advanced concepts in back-end development using Node.js, Express, and MongoDB. This course prepares you for a career in full-stack development.',
            'price' => 500000.00,
            'image_url' => 'https://i.ytimg.com/vi/Rn10b8pNxqM/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBBJagzf2cN9FPA1G4FNg9aAia5ng',
            'level'=> 3,
            'is_Free' => true,
            'mentor_id' => 3,
        ]);

        Course::create([
            'name' => 'Vue JS Scratch Course',
            'description' => 'Learn how to become a professional Illustrator now.',
            'sub_description' => 'In this course, you will master Vue.js from the basics to building advanced applications. You will also learn about Vue CLI, Vue Router, and Vuex to manage state effectively in large-scale applications.',
            'price' => 300000.00,
            'image_url' => 'https://i.ytimg.com/vi/36ZP6tOjroE/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLA0v275_mlKMz2g3za0Gna2Zu8uBA',
            'level'=> 3,
            'is_Free' => true,
            'mentor_id' =>3,
        ]);

        Course::create([
            'name' => 'Vue JS Scratch Course',
            'description' => 'Learn how to become a professional Illustrator now.',
            'sub_description' => 'This comprehensive course will cover the core concepts of Vue.js and how to create dynamic web applications. Students will build projects and work with real-world examples using Vue.js features like data binding, directives, components, and Vuex for state management.',
            'price' => 120000.00,
            'image_url' => 'https://img-c.udemycdn.com/course/240x135/5231088_b1e8_2.jpg',
            'level'=> 3,
            'is_Free' => true,
            'mentor_id' => 3,
        ]);

    }
}