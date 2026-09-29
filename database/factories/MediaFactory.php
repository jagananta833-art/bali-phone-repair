<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    public function definition(): array
    {
        return ['disk' => 'public', 'path' => 'media/example.jpg', 'alt_text' => fake()->sentence(3), 'mime_type' => 'image/jpeg', 'size' => 1024];
    }
}
