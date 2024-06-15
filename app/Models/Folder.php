<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Share;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'folders';
    protected $guarded = ['id'];
    public function parentFolder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_folder_id');
    }

    public function subFolders(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_folder_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'place_folder_id');
    }

    public function shares(): HasOne
    {
        return $this->hasOne(Share::class, 'item_slug', 'slug');
    }    

}
