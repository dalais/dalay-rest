<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all(['id', 'name', 'description']);
        $categories->each(function (Category $category) {
            $category->setAttribute('products_count', $category->products()->count());
        });
        return response()->json(['categories' => $categories->toArray()]);
    }
}
