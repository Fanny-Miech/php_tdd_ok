<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->title(),
            'description'=> $this->faker->paragraph(2),
            'published_at'=> now(),
            'author'=> User::factory()
        ];
    }
}
