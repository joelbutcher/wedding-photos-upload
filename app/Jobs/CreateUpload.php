<?php

namespace App\Jobs;

use App\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ramsey\Uuid\UuidInterface;

class CreateUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected UuidInterface  $uuid,
        protected string  $name,
        protected ?string $comment = null,
    ) { }

    public function handle(): void
    {
        Upload::create([
            'uuid' => $this->uuid,
            'name' => $this->name,
            'comment' => $this->comment
        ]);
    }
}
