<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return ['name' => fake()->name(), 'role' => 'Customer note', 'quote' => fake()->paragraph(), 'is_published' => true, 'sort_order' => 0];
    }
}
