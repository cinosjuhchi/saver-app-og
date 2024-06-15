<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Share extends Model
{
    use HasFactory;
    protected $table = 'shares';
    protected $guarded = ['id'];

    public function photos(): HasOne
    {
        return $this->hasOne(Photo::class, 'slug', 'item_slug');
    }

    public function folder(): HasOne
    {
        return $this->hasOne(Folder::class, 'slug', 'item_slug');
    }
}
