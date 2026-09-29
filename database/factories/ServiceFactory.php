<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'short_description' => fake()->sentence(),
            'content' => '<p>'.fake()->paragraph().'</p>',
            'meta_title' => Str::limit($name.' | Bali Phone Repair', 70, ''),
            'meta_description' => Str::limit(fake()->sentence(), 170, ''),
            'is_published' => true,
            'sort_order' => 0,
        ];
    }
}
