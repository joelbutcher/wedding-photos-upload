<?php

namespace App\Contracts\Repositories;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidInterface;

interface UploadRepository
{
    public function findOneByUuidFail(UuidInterface $uuid): Model | Upload;
}
