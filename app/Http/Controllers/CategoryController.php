<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'title' => 'All Category',
            'categories' => Category::first()->limit(3)->get(),
            'recentCategories' => Category::latest()->filter(request(['query']))->paginate(6)->withQueryString()
        ]);
    }
}
