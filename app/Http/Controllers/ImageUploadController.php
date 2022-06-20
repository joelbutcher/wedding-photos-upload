<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ImageRepository;
use App\Contracts\Repositories\UploadRepository;
use App\Http\Requests\UploadImagesRequest;
use App\Jobs\CreateImage;
use App\Jobs\CreateUpload;
use App\Jobs\UploadFileForImageToS3;
use App\Models\Image;
use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function __construct(
        private UploadRepository $uploadRepository,
        private ImageRepository $imageRepository,
    )
    {
    }

    public function __invoke(UploadImagesRequest $request)
    {
        $request->validated();

        $this->dispatchSync(new CreateUpload($uuid = Str::uuid(), $request->name(), $request->comment()));

        $upload = $this->uploadRepository->findOneByUuidFail($uuid);

        collect($request->images())->map(fn ($file) => $this->storeImage($upload, $file));
    }

    private function storeImage(Upload $upload, UploadedFile $file): Image | Model
    {
        $uuid = Str::uuid();
        $name = $file->hashName();

        $file->move(storage_path($path = 'app/uploads'), $name);

        $this->dispatchSync(new CreateImage($uuid, $upload, $file->hashName(), $path));

        $image = $this->imageRepository->findOneByHashFromFileOrFail($file);

        $this->dispatch(new UploadFileForImageToS3($image, $name));

        return $image->fresh();
    }
}
