<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Upload;
use Illuminate\Database\Seeder;

class UploadSeeder extends Seeder
{
    public function run(): void
    {
        Upload::factory(10)
            ->has(
                Image::factory(rand(0, 10))
            )->create();
    }
}
