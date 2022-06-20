<?php

namespace App\Models;

use App\Concerns\Models\HasId;
use Baro\PipelineQueryCollection\Concerns\Filterable;
use Baro\PipelineQueryCollection\Enums\WildcardPositionEnum;
use Baro\PipelineQueryCollection\RelativeFilter;
use Baro\PipelineQueryCollection\ScopeFilter;
use Baro\PipelineQueryCollection\Sort;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Jetstream\HasProfilePhoto;

class Upload extends Model
{
    use Filterable;
    use HasId;
    use HasProfilePhoto;
    use HasFactory;

    protected $fillable = [
        'uuid', 'name', 'email', 'comment',
    ];

    protected $withCount = [
        'images',
    ];

    protected $appends = [
      'profile_photo_url',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function comment(): ?string
    {
        return $this->comment;
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function getFilters(): array
    {
        return [
            new RelativeFilter('name'),
            new RelativeFilter('email'),
            new Sort(),
            new ScopeFilter('search')
        ];
    }
}
