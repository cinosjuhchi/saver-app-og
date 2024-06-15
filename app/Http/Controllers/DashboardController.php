<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = "Beranda";
        $filterActive = null;
        $identity = 'beranda';
        $folder = Folder::find(1);
        
        $location = $request->input('loc');

        if ($request->has('filter') && $request->input('filter') === 'photo') {
            $photos = $this->filterAppPhotos($location, $identity);
            $folders = collect(); // Empty collection as folders are not needed in this case            
            $filterActive = 'photo';
        } elseif ($request->has('filter') && $request->input('filter') === 'folder') {
            $folders = $this->filterAppFolders($location, $identity);
            $photos = collect(); // Empty collection as photos are not needed in this case            
            $filterActive = 'folder';
        } elseif($request->has('filter') && $request->input('filter') === 'oldest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'oldest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'oldest');
            $filterActive = 'oldest';
        } elseif($request->has('filter') && $request->input('filter') === 'latest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'latest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'latest');
            $filterActive = 'latest';
        }elseif($request->has('filter') && $request->input('filter') === 'asce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'asce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'asce');
            $filterActive = 'asce';
        }elseif($request->has('filter') && $request->input('filter') === 'desce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'desce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'desce');
            $filterActive = 'desce';
        }else {
            // Fetch both photos and folders if no specific filter is selected
            $photos = Photo::where('place_folder_id', 1)
            ->where('status', '!=', 'archive')
            ->get();
            $folders = Folder::where('parent_folder_id', 1)
            ->where('status', '!=', 'archive')
            ->get();;
        }
        return view('home', compact('folder', 'title', 'photos', 'folders', 'identity', 'filterActive'));

    }

    public function filterAppTime($loc, $iden, $type, $time) {
        if($iden == 'beranda' || $iden == 'folder') 
        {
            if($type == 'folder' && $time == 'oldest')
            {
                return Folder::oldest()
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'folder' && $time == 'latest')
            {
                return Folder::latest()
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }

            if($type == 'photo' && $time == 'oldest')
            {
                return Photo::oldest()
                ->where('place_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'photo' && $time == 'latest')
            {
                return Photo::latest()
                ->where('place_folder_id', $loc)
                ->where('status', '!=', 'archive')  
                ->get();
            }
        }
        if($iden == 'photo') 
        {
            if($type == 'folder' && $time == 'oldest')
            {
                return Folder::oldest()
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'folder' && $time == 'latest')
            {
                return Folder::latest()
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }

            if($type == 'photo' && $time == 'oldest')
            {
                return Photo::oldest()            
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'photo' && $time == 'latest')
            {
                return Photo::latest()                
                ->where('status', '!=', 'archive')  
                ->get();
            }
        }
        if($iden == 'favorite')
        {
            if($type == 'folder' && $time == 'oldest')
            {
                return Folder::oldest()                
                ->where('status', 'favorite')
                ->get();
            }elseif($type == 'folder' && $time == 'latest')
            {
                return Folder::latest()
                ->where('status', 'favorite')
                ->get();
            }

            if($type == 'photo' && $time == 'oldest')
            {
                return Photo::oldest()            
                ->where('status', 'favorite')
                ->get();
            }elseif($type == 'photo' && $time == 'latest')
            {
                return Photo::latest()                
                ->where('status', 'favorite')
                ->get();
            }
        }
        if($iden == 'archive')
        {
            if($type == 'folder' && $time == 'oldest')
            {
                return Folder::oldest()                
                ->where('status', 'archive')
                ->get();
            }elseif($type == 'folder' && $time == 'latest')
            {
                return Folder::latest()
                ->where('status', 'archive')
                ->get();
            }

            if($type == 'photo' && $time == 'oldest')
            {
                return Photo::oldest()            
                ->where('status', 'archive')
                ->get();
            }elseif($type == 'photo' && $time == 'latest')
            {
                return Photo::latest()                
                ->where('status', 'archive')
                ->get();
            }
        }
        
    }
    
    public function filterAppName($loc, $iden, $type, $name) {
        if($iden == 'beranda' || $iden == 'folder') 
        {
            if($type == 'folder' && $name == 'asce')
            {
                return Folder::orderBy('title') // Mengurutkan berdasarkan nama folder (title) secara ascending
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'folder' && $name == 'desce')
            {
                return Folder::orderBy('title', 'desc')
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }

            if($type == 'photo' && $name == 'asce')
            {
                return Photo::orderBy('title')
                ->where('place_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'photo' && $name == 'desce')
            {
                return Photo::orderBy('title', 'desc')
                ->where('place_folder_id', $loc)
                ->where('status', '!=', 'archive')  
                ->get();
            }
        }
        if($iden == 'photo') 
        {
            if($type == 'folder' && $name == 'asce')
            {
                return Folder::orderBy('title')
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'folder' && $name == 'desce')
            {
                return Folder::orderBy('title', 'desc')
                ->where('parent_folder_id', $loc)
                ->where('status', '!=', 'archive')
                ->get();
            }

            if($type == 'photo' && $name == 'asce')
            {
                return Photo::orderBy('title')            
                ->where('status', '!=', 'archive')
                ->get();
            }elseif($type == 'photo' && $name == 'desce')
            {
                return Photo::orderBy('title', 'desc')                
                ->where('status', '!=', 'archive')  
                ->get();
            }
        }
        if($iden == 'favorite')
        {
            if($type == 'folder' && $name == 'asce')
            {
                return Folder::orderBy('title')                
                ->where('status', 'favorite')
                ->get();
            }elseif($type == 'folder' && $name == 'desce')
            {
                return Folder::orderBy('title', 'desc')
                ->where('status', 'favorite')
                ->get();
            }

            if($type == 'photo' && $name == 'asce')
            {
                return Photo::orderBy('title')            
                ->where('status', 'favorite')
                ->get();
            }elseif($type == 'photo' && $name == 'desce')
            {
                return Photo::orderBy('title', 'desc')                
                ->where('status', 'favorite')
                ->get();
            }
        }
        if($iden == 'archive')
        {
            if($type == 'folder' && $name == 'asce')
            {
                return Folder::orderBy('title')                
                ->where('status', 'archive')
                ->get();
            }elseif($type == 'folder' && $name == 'desce')
            {
                return Folder::orderBy('title', 'desc')
                ->where('status', 'archive')
                ->get();
            }

            if($type == 'photo' && $name == 'asce')
            {
                return Photo::orderBy('title')            
                ->where('status', 'archive')
                ->get();
            }elseif($type == 'photo' && $name == 'desce')
            {
                return Photo::orderBy('title', 'desc')                
                ->where('status', 'archive')
                ->get();
            }
        }
        
    }

    private function filterAppPhotos($loc, $iden)
    {
        if($iden == 'beranda')
        {
            return Photo::where('place_folder_id', $loc)            
            ->where('status', '!=', 'archive')
            ->get();
        } 
        if($iden == 'archive')
        {
            return Photo::where('status', '=', 'archive')
            ->get();
        } 
        if($iden == 'favorite')
        {
            return Photo::where('status', '=', 'favorite')
            ->get();
        }
        
    }
    private function filterAppFolders($loc, $iden)
    {

        if($iden == 'beranda' || $iden == 'show')
        {
            return Folder::where('parent_folder_id', $loc)
            ->where('id', '!=', 1)
            ->where('status', '!=', 'archive')
            ->get();
        } 
        if($iden == 'archive')
        {
            return Folder::where('id', '!=', 1)
            ->where('status', '=', 'archive')
            ->get();
        } 
        if($iden == 'favorite')
        {
            return Folder::where('id', '!=', 1)
            ->where('status', '=', 'favorite')
            ->get();
        }

    }

    public function photo(Request $request)
    {
        $title = "Photo";
        $identity = 'photo';
        $filterActive = null;
        $folder = Folder::find(1);
        
        if($request->has('filter') && $request->input('filter') === 'oldest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'oldest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'oldest');
            $filterActive = 'oldest';
        } elseif($request->has('filter') && $request->input('filter') === 'latest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'latest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'latest');
            $filterActive = 'latest';
        }elseif($request->has('filter') && $request->input('filter') === 'asce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'asce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'asce');
            $filterActive = 'asce';
        }elseif($request->has('filter') && $request->input('filter') === 'desce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'desce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'desce');
            $filterActive = 'desce';
        } else{
            $photos = Photo::where('status', '!=', 'archive')->get();
            $folders = Folder::where('status', '!=', 'archive')
            ->where('parent_folder_id', 1)
            ->where('id', '!=', 1)
            ->get();
        }
        return view('home', compact('title', 'photos','folders', 'identity', 'filterActive', 'folder'));

    }

    public function folder(Request $request)
    {
        $identity = 'folder';        
        $title = "Folder";
        $filterActive = null;
        $folder = Folder::find(1);
        
        if($request->has('filter') && $request->input('filter') === 'oldest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'oldest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'oldest');
            $filterActive = 'oldest';
        } elseif($request->has('filter') && $request->input('filter') === 'latest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'latest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'latest');
            $filterActive = 'latest';
        }elseif($request->has('filter') && $request->input('filter') === 'asce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'asce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'asce');
            $filterActive = 'asce';
        }elseif($request->has('filter') && $request->input('filter') === 'desce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'desce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'desce');
            $filterActive = 'desce';
        } else{
            $photos = Photo::where('status', '!=', 'archive')->get();
            $folders = Folder::where('status', '!=', 'archive')
            ->where('parent_folder_id', 1)
            ->where('id', '!=', 1)
            ->get();
        }

        
        return view('home', compact('title', 'photos', 'folder', 'folders', 'identity', 'filterActive'));

    }

    
    public function archive(Request $request)
    {
        $identity = 'archive';
        $title = "Archive";
        $filterActive = null;
        $folder = Folder::find(1);
        $location = null;

        if ($request->has('filter') && $request->input('filter') === 'photo') {
            $photos = $this->filterAppPhotos($location, $identity);
            $folders = collect(); // Empty collection as folders are not needed in this case            
            $filterActive = 'photo';
        } elseif ($request->has('filter') && $request->input('filter') === 'folder') {
            $folders = $this->filterAppFolders($location, $identity);
            $photos = collect(); // Empty collection as photos are not needed in this case            
            $filterActive = 'folder';
        } elseif($request->has('filter') && $request->input('filter') === 'oldest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'oldest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'oldest');
            $filterActive = 'oldest';
        } elseif($request->has('filter') && $request->input('filter') === 'latest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'latest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'latest');
            $filterActive = 'latest';
        }elseif($request->has('filter') && $request->input('filter') === 'asce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'asce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'asce');
            $filterActive = 'asce';
        }elseif($request->has('filter') && $request->input('filter') === 'desce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'desce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'desce');
            $filterActive = 'desce';
        } else {
            // Fetch both photos and folders if no specific filter is selected
            $photos = Photo::where('status', 'archive')
            ->get();
            $folders = Folder::where('status', 'archive')
            ->get();;
        }        
        return view('home', compact('folder', 'title', 'photos','folders', 'identity', 'filterActive'));

    }
    public function favorite(Request $request)
    {
        $identity = 'favorite';
        $title = "Favorite";
        $filterActive = null;
        $folder = Folder::find(1);
        $location = null;
        if ($request->has('filter') && $request->input('filter') === 'photo') {
            $photos = $this->filterAppPhotos($location, $identity);
            $folders = collect(); // Empty collection as folders are not needed in this case            
            $filterActive = 'photo';
        } elseif ($request->has('filter') && $request->input('filter') === 'folder') {
            $folders = $this->filterAppFolders($location, $identity);
            $photos = collect(); // Empty collection as photos are not needed in this case            
            $filterActive = 'folder';
        } elseif($request->has('filter') && $request->input('filter') === 'oldest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'oldest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'oldest');
            $filterActive = 'oldest';
        } elseif($request->has('filter') && $request->input('filter') === 'latest' ) {
            $folders = $this->filterAppTime(1, $identity, 'folder', 'latest');
            $photos = $this->filterAppTime(1, $identity, 'photo', 'latest');
            $filterActive = 'latest';
        }elseif($request->has('filter') && $request->input('filter') === 'asce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'asce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'asce');
            $filterActive = 'asce';
        }elseif($request->has('filter') && $request->input('filter') === 'desce' ) {
            $folders = $this->filterAppName(1, $identity, 'folder', 'desce');
            $photos = $this->filterAppName(1, $identity, 'photo', 'desce');
            $filterActive = 'desce';
        } else {
            // Fetch both photos and folders if no specific filter is selected
            $photos = Photo::where('status', 'favorite')
            ->get();
            $folders = Folder::where('status', 'favorite')
            ->get();;
        }
        return view('home', compact('folder', 'title', 'photos','folders', 'identity', 'filterActive'));

    }

    public function searchFiles(Request $request)
    {
        $identity = 'search';
        $search = $request->input('search_title');
        $category = $request->input('title_search');
        $folder = Folder::find($request->input('parent'));
        $title = $category;
        $filterActive = null;

    if ($search) {
        if($category == 'Beranda' || $category == 'Folder' || $category == 'Photo'){
            $photos = Photo::where('title', 'like', "%{$search}%")
            ->where('status', '!=', 'archive')
            ->get();
            $folders = Folder::where('title', 'like', "%{$search}%")
            ->where('status', '!=', 'archive')
            ->get();
        }elseif($category == 'Archive'){
            $photos = Photo::where('title', 'like', "%{$search}%")
            ->where('status', '=', 'archive')
            ->get();
            $folders = Folder::where('title', 'like', "%{$search}%")
            ->where('status', '=', 'archive')
            ->get();
        }elseif($category == 'Favorite'){
            $photos = Photo::where('title', 'like', "%{$search}%")
            ->where('status', '=', 'favorite')
            ->get();
            $folders = Folder::where('title', 'like', "%{$search}%")
            ->where('status', '=', 'favorite')
            ->get();
        }else{
            $photos = Photo::where('title', 'like', "%{$search}%")
            ->where('place_folder_id', '=', $folder->id)
            ->where('status', '!=', 'archive')
            ->get();
            $folders = Folder::where('title', 'like', "%{$search}%")
            ->where('parent_folder_id', '=', $folder->id)
            ->where('status', '!=', 'archive')
            ->get();
        }

        
    } else {
        // Jika pencarian kosong, tampilkan semua file
        if($category == 'Beranda' || $category == 'Photo' || $category == 'Folder'){
            $photos = Photo::where('status', '!=', 'archive')->get();
             $folders = Folder::where('status', '!=', 'archive')->get();
        }
        if($category == 'Archive'){
            $photos = Photo::where('status', '=', 'archive')->get();
             $folders = Folder::where('status', '=', 'archive')->get();
        }
        if($category == 'Favorite'){
            $photos = Photo::where('status', '=', 'favorite')->get();
             $folders = Folder::where('status', '=', 'favorite')->get();
        }
        
        }

    return view('home', compact('photos', 'folders', 'title', 'identity', 'filterActive', 'folder'));
    }

}
