<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function create(): View
    {
        $categories = Category::query()->get();
        return view('products.form', ['categories' => $categories]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $file = $data['image'];
        $imageName = $file->hashName();
        $file->move(public_path('storage/images'), $imageName);
        $data['image'] = $imageName;
        Product::query()->create($data)->categories()->attach($data['category']);
        return redirect()->route('index')
            ->with('message', 'Product Added successfully!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect(route('index'))
            ->with('message', 'Product Deleted successfully!');
    }

    public function edit(Product $product): View
    {
        $categories = Category::query()->get();
        return view('products.form',
            ['product' => $product, 'categories' => $categories]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        if (isset($request->image)) {
            $file = $request['image'];
            $imageName = $file->hashName();
            $file->move(public_path('storage/images'), $imageName);
            $data['image'] = $imageName;
        }
        $product->categories()->sync($data['category']);
        $product->update($data);
        return redirect()->route('index')
            ->with('message', 'Product Updated successfully!');
    }
}
