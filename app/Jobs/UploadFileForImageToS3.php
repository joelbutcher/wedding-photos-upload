<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadFileForImageToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private Image $image,
        private string $filename,
        private string $originDisk = 'local',
        private string $originPath = 'uploads',
    ) { }

    public function handle(): void
    {
        $file = Storage::disk($this->originDisk)->get(
            "$this->originPath/$this->filename"
        );

        $filepath = config('filesystems.disks.s3.path');

        Storage::cloud()->put("$filepath/$this->filename", $file);

        $this->image->fill([
            'url' => Storage::cloud()->url("$filepath/$this->filename"),
            'uploaded_at' => now(),
        ])->save();
    }
}
