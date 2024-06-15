<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    //
    public function downloadImage($slug)
    {
        $file = Photo::where('slug', $slug)->first();
        $nameFile =  $file->image_location;
        $title = $file->title;
        $extension = pathinfo($nameFile, PATHINFO_EXTENSION);
        $title .= '.'.$extension;

        return Storage::download($nameFile, $title);
    }
}
