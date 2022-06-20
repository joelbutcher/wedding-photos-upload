<?php

namespace App\Repositories;

use App\Contracts\Repositories\UploadRepository as UploadRepositoryContract;
use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidInterface;

class UploadRepository implements UploadRepositoryContract
{
    public function findOneByUuidFail(UuidInterface $uuid): Model|Upload
    {
        return Upload::query()
            ->where('uuid', $uuid->toString())
            ->firstOrFail();
    }
}
