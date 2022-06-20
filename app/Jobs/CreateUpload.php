<?php

namespace App\Jobs;

use App\Http\Requests\CreateUploadRequest;
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
        protected string  $email,
        protected ?string $comment = null,
    ) { }

    public static function fromRequest(UuidInterface $uuid, CreateUploadRequest $request): self
    {
        return new self(
            $uuid,
            $request->name(),
            $request->email(),
            $request->comment(),
        );
    }

    public function handle(): void
    {
        Upload::create([
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'comment' => $this->comment
        ]);
    }
}
