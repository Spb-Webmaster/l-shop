<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $categories = CategoryViewModel::make()->homePage();

        $brands = BrandViewModel::make()->homePage();

        $products = Product::query()
            ->homePage()
            ->get();


        return  view('index', compact(
            'categories',
            'brands',
            'products'
        ));
    }
}
