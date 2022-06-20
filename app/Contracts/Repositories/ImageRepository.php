<?php

namespace App\Contracts\Repositories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface ImageRepository
{
    public function findOneByHashFromFileOrFail(UploadedFile $file): Model | Image;
}
