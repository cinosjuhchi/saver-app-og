<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DirectoryController extends Controller
{
    public function directory(Request $request)
    {
        $id = $request->route("id_parent");
        $parent = Folder::find($id);
        $type = $request->route("type");    
        $content = $request->route("content");
        $filterActive = null;
        $identity = 'directory';
        $title = 'Ganti Penyimpanan';
        $folder = Folder::find($id);
        if($parent->id == 1)
        {
            $bread = Folder::find(1);
        } else {
            $bread = Folder::find($parent->parent_folder_id);
        }
        

        $subFolders = $parent->subFolders()->where('status', '!=', 'archive')->get();
        $photos = $parent->photos()->where('status', '!=', 'archive')->get();

        $breadcrumb = [];

        $breadcrumb = $this->createBreadcrumb($bread->title, route('change-directory', ['id_parent' => $bread->id, 'type' => $type, 'content' => $content]));

        return view('changeDirectory', compact('parent', 'content', 'type', 'subFolders', 'photos', 'filterActive', 'title', 'folder', 'identity', 'breadcrumb'));
    }

    public function update(Request $request)
    {
        $parent = $request->input('id_parent');
        $type = $request->input('type');
        $content = $request->input('content');
        $current = Folder::find($parent);
        if($type == 'photo')
        {
            $photo = Photo::find($content);
            $photo->place_folder_id = $parent;
            $photo->save();
        }else {
            $folder = Folder::find($content);
            $folder->parent_folder_id = $parent;
            $folder->save();
        }
        if($current->id != 1)
        {            
            return redirect()->route('folder-show', ['slug' => $current->slug])->with('success','Penyimpanan berhasil diubah!');
        } else{
            return redirect()->route('dashboard')->with('success','Penyimpanan berhasil diubah!');
        }
    }

    private function createBreadcrumb($label, $url)
{
    return [
        'label' => $label,
        'url' => $url,
    ];
}

}
