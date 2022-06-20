<?php

namespace App\Providers;

use App\Contracts\Repositories\ImageRepository as ImageRepositoryContract;
use App\Contracts\Repositories\UploadRepository as UploadRepositoryContract;
use App\Repositories\ImageRepository;
use App\Repositories\UploadRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ImageRepositoryContract::class, ImageRepository::class);
        $this->app->bind(UploadRepositoryContract::class, UploadRepository::class);
    }

    public function boot()
    {
        //
    }
}
