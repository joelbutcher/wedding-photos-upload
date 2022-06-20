<?php

namespace App\Jobs;

use App\Models\Upload;
use Illuminate\Foundation\Bus\Dispatchable;
use Ramsey\Uuid\UuidInterface;

class CreateImage
{
    use Dispatchable;

    public function __construct(
        private UuidInterface $uuid,
        private Upload $upload,
        private string $hashName,
        private string $path,
        private string $disk = 'local',
    ) { }

    public function handle(): void
    {
        $this->upload->images()->create([
            'hash' => $this->hashName,
            'path' => $this->path,
            'disk' => $this->disk,
        ]);
    }
}
