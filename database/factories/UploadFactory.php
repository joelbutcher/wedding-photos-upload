<?php

namespace Database\Factories;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upload>
 */
class UploadFactory extends Factory
{
    protected $model = Upload::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->unique()->uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'comment' => $this->faker->sentence(),
        ];
    }
}
