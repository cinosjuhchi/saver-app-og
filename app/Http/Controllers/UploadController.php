<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Folder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ShareController;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image_location.*' => 'image|file|max:50014',
        ]);
    
        $uploadedImages = [];
    
        foreach ($request->file('image_location') as $image) {
            $title = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $counter = 1;
            $newName = $title;
    
            while (Photo::where('title', $newName)->exists()) {
                $newName = $title . '(' . $counter . ')';
                $counter++;
            }
    
            $title = $newName;
    
            $folder = $request->parent_folder_id ?? 1;
            $slug = Str::slug($title);
            
            if (empty($slug) || strlen($slug) <= 3) {
                $slug = Str::random(18); // Ubah panjang slug sesuai kebutuhan
            }
        
            $counterSlug = 1;
            $newSlug = $slug;
            while (Photo::where('slug', $newSlug)->exists()) {
                $newSlug = $slug . '-' . $counterSlug;
                $counter++;
            }
            $slug = $newSlug;            

            $status = "active";

            $shareLink = new ShareController();
            $shareLink->generateShareLink('photo', $slug);

            
            $photo = new Photo();
            $photo->title = $title;
            $photo->image_location = $image->store('user-images');
            $photo->place_folder_id = $folder;
            $photo->slug = $slug;
            $photo->status = $status;
            $photo->save();
    
            $uploadedImages[] = $photo;
        }
    
        return back()->with('success', 'Gambar berhasil diunggah')->with('uploadedImages', $uploadedImages);
    }


    public function update(Request $request)
    {
        $type = $request->input('type');
        $title = $request->input('title');
        $id = $request->input('id_content');

        if($type == 'photo')
        {
            $photo = Photo::find($id);
            $photo->title = $title;
            $photo->save();
            return back()->with('success', 'Nama berhasil diubah');
        }else{
            $folder = Folder::find($id);
            $folder->title = $title;
            $folder->save();
            return back()->with('success', 'Nama berhasil diubah');
        }

    }
    

}
