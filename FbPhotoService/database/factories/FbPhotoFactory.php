<?php

namespace Database\Factories;

use App\Models\FbPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class FbPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FbPhoto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->name,
            'picture' => $this->faker->imageUrl,
            'user_id' => 1
        ];
    }
}
