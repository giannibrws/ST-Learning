<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Notes extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id', 'name', 'content'];

    /*
    * @function: adds image conversions for ckeditor media.
    */

    public function registerMediaConversions(Media $media = null): void
    {
        // TODO: Implement registerMediaConversions() method.
        $this->addMediaConversion('imgSize')
            ->width(500)
            ->height(500)
            ->sharpen(10)
            ->border(2, 'black');
    }

}
