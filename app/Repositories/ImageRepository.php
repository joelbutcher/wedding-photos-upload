<?php

namespace App\Repositories;

use App\Contracts\Repositories\ImageRepository as ImageRepositoryContract;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ImageRepository implements ImageRepositoryContract
{
    public function findOneByHashFromFileOrFail(UploadedFile $file): Model|Image
    {
        return Image::query()->where('hash', $file->hashName())->firstOrFail();
    }
}
