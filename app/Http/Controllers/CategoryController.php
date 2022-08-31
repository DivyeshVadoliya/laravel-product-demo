<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(): View
    {
        $categories = Category::query()->orderByDesc('id')
            ->simplePaginate(10, '*', 'categories');
        return view('admin.category', ['categories' => $categories]);
    }

    public function create(): View
    {
        return view('categories.form');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::query()->create($request->validated());
        return redirect()->route('category.show')
            ->with('category', 'Category added successfully!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('category.show')
            ->with('category', 'Category deleted successfully!');
    }

    public function edit(Category $category): View
    {
        return view('categories.form', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('category.show')
            ->with('category', 'Category Updated successfully!');
    }
}
