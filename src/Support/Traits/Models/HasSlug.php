<?php

namespace Support\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $item) {

            $slug = self::generateUniqueSlug($item->{self::SlugFrom()}, 0 , 'slug');
            $item->slug = $item->slug ?? $slug;
            //$item->slug = $item->slug ?? str($item->{self::SlugFrom()})->append(time())->slug();

        });
    }

    public static function SlugFrom(): string
    {
        return 'title';
    }

    public static  function generateUniqueSlug($title,$counter=0,$slugField="slug")
    {
        $updatedName = $counter==0?$title:$title."-".$counter;
        if (static::where($slugField,str::slug($updatedName))->exists()) {
            return  self::generateUniqueSlug($title,$counter+1);
        }
        return str::slug($updatedName);
    }

}
