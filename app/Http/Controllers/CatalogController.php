<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(?Category $category)
    {


        $categories  = Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();

        $products  = Product::query()
            ->with('brand')
            ->when(request('s'), function (Builder $q)
            {
                $q->whereFullText(['title', 'text'], request('s'));
            })
            ->select(['id', 'title','text', 'slug', 'thumbnail', 'price', 'brand_id'])
            ->when($category->exists, function(Builder $query)
            use ($category){
                $query->whereRelation('categories',
                    'categories.id',
                    '=',
                            $category->id);

            })
            ->filtered()
            ->sorted()
            ->paginate(6);


        return view('catalog.index' , [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
        ]);

    }

}
