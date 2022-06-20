<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * {@inheritDoc}
     */
    protected $model = Image::class;

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        return [
            'hash' => $this->faker->md5(),
            'disk' => $disk = $this->faker->randomElement(['local', 's3']),
            'path' => '/uploads/',
            'url' => $disk === 's3' ? $this->faker->imageUrl() : null,
            'uploaded_at' => $disk === 's3' ? $this->faker->date() : null,
        ];
    }
}
