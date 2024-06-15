<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Share;
use App\Models\Folder;
use App\Models\ShareLink;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;

class ShareController extends Controller
{
    public function generateShareLink($type, $itemSlug)
    {
        // Logic untuk membuat tautan bagikan

        $shareLink = new Share();            
        $shareLink->link = sha1($type . $itemSlug . microtime());        
        $shareLink->type = $type;
        $shareLink->item_slug = $itemSlug;
        $shareLink->save();

    }

    public function showFolder(Request $request)
    {
        $link = $request->route('link');
        $share = Share::where('link', $link)->first();
        if(!$share)
        {
            abort(404);
        }
        $title = 'Guest';
        $folder = Folder::where('slug', $share->item_slug)->firstOrFail();
        $origin = $folder->shares->link;
        $photos = $folder->photos->where('status', '!=', 'archive');   
        $subFolders = $folder->subFolders->where('status', '!=', 'archive');

        return view('guest.folderGuest', compact('title', 'origin','photos','subFolders', 'folder'));


    }

    protected function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
    
        $bytes /= pow(1024, $pow);
    
        return round($bytes, $precision) . ' ' . $units[$pow];
        }

    public function showPhoto(Request $request){
        $link = $request->route('link');
        $share = Share::where('link', $link)->first();
        if(!$share)
        {
            abort(404);
        }
        $title = 'Guest';
        $photo = Photo::where('slug', $share->item_slug)->firstOrFail();
        $ukuran = filesize('storage/' . $photo->image_location);
        $ukuran = $this->formatBytes($ukuran);
        return view('guest.previewGuest', compact('title', 'photo', 'ukuran'));
    }

    public function showSubFolder(Request $request)
    {
        $link = $request->route('link');
        $origin = $request->route('parent');        
        $share = Share::where('link', $link)->first();
        if(!$share)
        {
            abort(404);
        }
        $title = 'Guest';
        $folder = Folder::where('slug', $share->item_slug)->firstOrFail();
        $parent = $folder->parent_folder_id;
        $parent = Folder::find($parent);
        $subFolders = $folder->subFolders->where('status', '!=', 'archive');
        $photos = $folder->photos->where('status', '!=', 'archive');   
        $breadcrumb = [];
        

        if($parent->shares->link == $origin){
            $breadcrumb = $this->createBreadcrumb($parent->title, route('folder.guest', ['link' => $origin]));
        }else{
            $breadcrumb = $this->createBreadcrumb($parent->title, route('subFolder.guest', ['parent' => $parent->parent_folder_id, 'link' => $parent->shares->link]));
        }


        return view('guest.subFolderGuest', compact('title', 'parent', 'photos', 'subFolders', 'origin', 'folder', 'breadcrumb'));
    }


    private function createBreadcrumb($label, $url)
{
    return [
        'label' => $label,
        'url' => $url,
    ];
}

}
