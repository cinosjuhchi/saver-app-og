<?php

use App\Models\Photo;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\AuthenticateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });


// Guest
Route::get('/share-folder/{link}', [ShareController::class, 'showFolder'])->name('folder.guest');
Route::get('/share-folder/{parent}/{link}', [ShareController::class, 'showSubFolder'])->name('subFolder.guest');
Route::get('/share-photo/{link}', [ShareController::class, 'showPhoto'])->name('preview.guest');

// Admin
Route::get("/", [DashboardController::class,"index"])->middleware('auth')->name('dashboard');
Route::get("/filter-dashboard", [DashboardController::class,"index"])->middleware('auth')->name('dashboard.filter');
Route::get("/filter-folder/{slug}", [FolderController::class,"show"])->middleware('auth')->name('folder.filter');
Route::get("/filter-folder", [DashboardController::class, 'folder'])->middleware('auth')->name('folder.all.filter');
Route::get("/filter-photo", [DashboardController::class, 'photo'])->middleware('auth')->name('photo.all.filter');
Route::get("/filter-archive", [DashboardController::class,"archive"])->middleware('auth')->name('archive.filter');
Route::get("/filter-favorite", [DashboardController::class,"favorite"])->middleware('auth')->name('favorite.filter');
Route::get('/autentikasi', [AuthenticateController::class, 'index'])->name('login');
Route::post('login', [AuthenticateController::class,'login'])->name('authlogin');
Route::get('/logout', [AuthenticateController::class,'logout'])->middleware('auth')->name('logout');
Route::post('upload-photo', [UploadController::class,'upload'])->middleware('auth')->name('upload-photo');
Route::post('change-name', [UploadController::class, 'update'])->middleware('auth')->name('change-name');
Route::get('/delete-folder/{id}', [FolderController::class,'delete'])->middleware('auth')->name('delete-folder');
Route::get('/delete-photo/{id}', [PhotoController::class,'delete'])->middleware('auth')->name('delete-photo');
Route::get('/preview/{slug}', [PhotoController::class, 'show'])->middleware('auth')->name('preview');


Route::post('add-folder', [FolderController::class, 'store'])->middleware('auth')->name('add-folder');
Route::get('/download/{slug}', [DownloadController::class, 'downloadImage'])->name('download-image');
Route::get('/folders/{slug}', [FolderController::class,'show'])->middleware('auth')->name('folder-show');
Route::get('/change-directory/{id_parent}/{type}/{content}', [DirectoryController::class, 'directory'])->middleware('auth')->name('change-directory');
Route::post('update-directory', [DirectoryController::class, 'update'])->middleware('auth')->name('update-directory');
// web.php  
// Route::get('/folders/{slug}', [FolderController::class, 'show'])->middleware('auth')->name('folder-show');
Route::get('/download-zip/{id}', [FolderController::class, 'zipFolder'])->middleware('auth')->name('download-zip');
Route::get('/search-files', [DashboardController::class, 'searchFiles'])->name('search-files');
Route::get('/search-files-folder', [FolderController::class, 'searchFiles'])->name('folder.search-files');
Route::get('/favorite-folder/{id}', [FolderController::class,'favorite'])->middleware('auth')->name('favorite-folder');
Route::get('/favorite-photo/{id}', [PhotoController::class,'favorite'])->middleware('auth')->name('favorite-photo');
Route::get('/archive-folder/{id}', [FolderController::class,'archive'])->middleware('auth')->name('archive-folder');
Route::get('/archive-photo/{id}', [PhotoController::class,'archive'])->middleware('auth')->name('archive-photo');
Route::get('/unstatus-folder/{id}', [FolderController::class,'unstatus'])->middleware('auth')->name('unstatus-folder');
Route::get('/unstatus-photo/{id}', [PhotoController::class,'unstatus'])->middleware('auth')->name('unstatus-photo');
Route::get('/photo', [DashboardController::class, 'photo'])->middleware('auth')->name('all-photo');
Route::get('/folder', [DashboardController::class, 'folder'])->middleware('auth')->name('all-folder');
Route::get('/archive', [DashboardController::class, 'archive'])->middleware('auth')->name('all-archive');
Route::get('/favorite', [DashboardController::class, 'favorite'])->middleware('auth')->name('all-favorite');

