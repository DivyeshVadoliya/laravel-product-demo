<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->simplePaginate(4, '*', 'categories');
        $products = Product::query()
            ->simplePaginate(4, '*', 'products');
        return view('index', ['categories' => $categories, 'products' => $products]);
    }
}
