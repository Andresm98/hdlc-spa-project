<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TestAWS;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;


class TestAWSController extends Controller
{

    public function index()
    {
        // $image =     Storage::disk('s3')->response('/documents/daugther-profiles/image/agucha6662022-575/F6jumP1u3rBozc15ILd8szjecANGgN96U9gMPmv5.jpg');
        $image =     Storage::disk('s3')->temporaryUrl('documents/daugther-profiles/image/agucha6662022-575/F6jumP1u3rBozc15ILd8szjecANGgN96U9gMPmv5.jpg', now()->addSeconds(5));
        // $image = 'https://programacion.net/files/article/20161004091044_vim.png';
        return Inertia::render('Welcome', compact('image'));
    }

    public function store(Request $request)
    {

        $path = $request->file('file')->store('/', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        $image = TestAWS::create([
            'filename' => basename($path),
            'url' => Storage::disk('s3')->url($path)
        ]);

        return $image;
    }

    public function show()
    {
        return Storage::disk('s3')->response('/documents/daugther-profiles/image/adasd23423-231/wQp7DvqT3FkzW3USYw1dGn0xnQaw81J3gL6oSYj3.jpg');
    }
}
