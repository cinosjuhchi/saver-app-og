<?php

namespace App\Models;

use App\Models\Share;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $guarded = ['id'];

    public function shares(): HasOne
    {
        return $this->hasOne(Share::class, 'item_slug', 'slug');
    }


    
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'place_folder_id');
    }

}
