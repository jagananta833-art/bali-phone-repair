<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceAreaFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->city();

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(100, 999),
            'description' => fake()->sentence(),
            'long_description' => '<p>'.fake()->paragraph().'</p>',
            'hero_image' => 'service-optimized.jpg',
            'hero_image_alt' => 'Test location image',
            'meta_title' => Str::limit($name.' service location', 70, ''),
            'meta_description' => Str::limit(fake()->sentence(), 170, ''),
            'is_published' => true,
            'is_indexable' => true,
            'sort_order' => 0,
        ];
    }
}
