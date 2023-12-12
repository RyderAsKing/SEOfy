<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $extra_attributes = [];
        for ($i = 0; $i < rand(1, 5); $i++) {
            $extra_attributes[$this->faker->word] = $this->faker->sentence;
        }

        return [
            //
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'url' => $this->faker->url,
            'user_id' => \App\Models\User::factory(),
            'custom_fields' => $extra_attributes,
        ];
    }
}
