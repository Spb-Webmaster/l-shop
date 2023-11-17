<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $product)
    {

        return view('product.show' , [
            'product' => $product,
        ]);

    }

}
