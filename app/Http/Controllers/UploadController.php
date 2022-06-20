<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UploadController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Uploads', [
            'uploads' => Upload::query()
                ->filter()
                ->paginate()
                ->appends($request->query()),
        ]);
    }

    public function show(Upload $upload): Response
    {
        return Inertia::render('Upload/Show', [
            'upload' => $upload,
        ]);
    }
}
