<?php

namespace App\Models;

use App\Concerns\Models\HasId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasId;
    use HasFactory;

    protected $fillable = [
        'hash', 'disk', 'path', 'url', 'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'timestamp'
    ];

    public function hash(): string
    {
        return $this->hash;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function disk(): string
    {
        return $this->disk;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function uploadedAt(): Carbon
    {
        return $this->uploaded_at;
    }

    public function uploaded(): bool
    {
        return null !== $this->uploaded_at;
    }

    public function isUploaded(): bool
    {
        return $this->uploaded();
    }

    public function isNotUploaded(): bool
    {
        return !$this->uploaded();
    }

    public function upload(): BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }
}
