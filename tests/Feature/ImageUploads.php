<?php

namespace Tests\Feature;

use App\Models\Upload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

afterEach(function () {
    // Remove all temp stored files
    Storage::disk('local')->delete(Storage::disk('local')->allFiles('uploads'));
});

it('can upload images', function () {
    Config::set('filesystems.disks.s3.path', 'custom-s3-path');

    Storage::fake('s3');

    $images = [
        UploadedFile::fake()->image('image1.jpg'),
        UploadedFile::fake()->image('image2.jpg'),
        UploadedFile::fake()->image('image3.jpg'),
        UploadedFile::fake()->image('image4.jpg'),
    ];

    $response = $this->post(route('images.post'), [
        'name' => 'Taylor & Abigail',
        'images' => $images,
        'comment' => 'This is a cool comment',
    ]);

    $response->assertOk();

    $upload = Upload::first();

    $this->assertEquals('Taylor & Abigail', $upload->name());
    $this->assertEquals('This is a cool comment', $upload->comment());
    $this->assertCount(4, $upload->images);

    expect($upload->images)->sequence(
        fn ($file) => $this->assertTrue($file->value->uploaded()),
        fn ($file) => $this->assertTrue($file->value->uploaded()),
        fn ($file) => $this->assertTrue($file->value->uploaded()),
        fn ($file) => $this->assertTrue($file->value->uploaded()),
    );

    expect($upload->images)->sequence(
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
    );
});

it('can upload images without a comment', function () {
    Config::set('filesystems.disks.s3.path', 'custom-s3-path');

    Storage::fake('s3');

    $images = [
        UploadedFile::fake()->image('image1.jpg'),
        UploadedFile::fake()->image('image2.jpg'),
        UploadedFile::fake()->image('image3.jpg'),
        UploadedFile::fake()->image('image4.jpg'),
    ];

    $response = $this->post(route('images.post'), [
        'name' => 'Taylor & Abigail',
        'images' => $images,
    ]);

    $response->assertOk();

    $upload = Upload::first();

    $this->assertEquals('Taylor & Abigail', $upload->name());
    $this->assertNull($upload->comment());
    $this->assertCount(4, $upload->images);

    expect($upload->images)->sequence(
        fn ($file) => $this->assertTrue($file->value->uploaded()),
        fn ($file) => $this->assertTrue($file->value->uploaded()),
        fn ($file) => $this->assertTrue($file->value->uploaded()),
        fn ($file) => $this->assertTrue($file->value->uploaded()),
    );

    expect($upload->images)->sequence(
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
        fn ($file) => Storage::disk('s3')->assertExists("custom-s3-path/{$file->value->hash()}"),
    );
});


it("can't upload images without a name", function () {
    Config::set('filesystems.disks.s3.path', 'custom-s3-path');

    Storage::fake('s3');

    $images = [
        UploadedFile::fake()->image('image1.jpg'),
        UploadedFile::fake()->image('image2.jpg'),
        UploadedFile::fake()->image('image3.jpg'),
        UploadedFile::fake()->image('image4.jpg'),
    ];

    $response = $this->post(route('images.post'), [
        'images' => $images,
    ]);

    $response->assertSessionHasErrors([
        'name' => 'The name field is required.',
    ]);
});
