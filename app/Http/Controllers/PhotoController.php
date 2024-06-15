<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    protected function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function show($slug)
    {
        $title = 'Preview';
        $id = $slug;
        $photo = Photo::where('slug', $id)->first();
        $ukuran = filesize('storage/' . $photo->image_location);

        $ukuran = $this->formatBytes($ukuran);

        return view('preview', compact('title', 'photo', 'ukuran'));
    }

    public function delete($id)
{
    // Cari foto berdasarkan ID
    $photo = Photo::findOrFail($id);

    // Periksa apakah foto ditemukan sebelum mencoba menghapusnya
    if ($photo) {
        // Hapus foto
        $photo->delete();
        
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Berhasil dihapus');
    } else {
        // Redirect kembali dengan pesan kesalahan
        return redirect()->back()->with('error', 'Foto tidak ditemukan');
    }
}


    public function archive($id)
    {
        $photo = Photo::find($id);
        $photo->update(['status' => 'archive']);
        return back()->with('success', 'Diarsipkan');
    }
    public function unstatus($id)
    {
        $photo = Photo::find($id);
        $photo->update(['status' => 'active']);
        return back()->with('success', 'Berhasil Dihapus');
    }

    public function favorite($id)
    {
        $photo = Photo::find($id);
        $photo->update(['status' => 'favorite']);
        return back()->with('success', 'Difavoritkan');
    }
}
