<?php

namespace App\Models;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Casts\PriceCast;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'price',
        'thumbnail',
        'on_home_page',
        'sorting',
        'text'

    ];
    protected $casts = [
        'price' => PriceCast::class
    ];

    protected function thumbnailDir(): string
    {
        return 'products';
    }

    public function scopeFiltered(Builder $query)
    {
        foreach (filters() as $filter)
        {
            $query = $filter->apply($query);

        }
  /*
  // старая реализация без abstract class
       $query->when(request('filters.brands'), function (Builder $q) {
            $q->whereIn('brand_id', request('filters.brands'));
        })->when(request('filters.price'), function (Builder $q) {
            $q->whereBetween('price', [
                request('filters.price.from', 0) * 100,
                request('filters.price.to', 100000) * 100
            ]);
        });*/


    }

    public function scopeSorted(Builder $query)
    {
        $query->when(request('sort'), function (Builder $q) {

            $column = request()->str('sort');
            if($column->contains(['price', 'title'])) {
                $direction = $column->contains('-')?'DESC':'ASC';
                $q->orderBy((string)$column->remove('-'), $direction);
            }

        });

    }

    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->with('brand')
            ->orderBy('sorting')
            ->limit(6);

    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->withPivot('value');

    }


    protected static function boot()
    {
        parent::boot();

        // dump('Model');

    }
    // возможно переопределить логику
    // если в модели не title а , например, name
    // то slug будет в этой модели формироватся из name
    // должен быть подключен trait

    /*    public static function SlugFrom(): string
        {
            return 'name';
        }*/


}
