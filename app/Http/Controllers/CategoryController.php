<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('contracts')->get();

        return view('categories.index', compact('categories'));
    }
}