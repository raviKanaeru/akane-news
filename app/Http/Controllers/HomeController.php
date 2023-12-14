<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {

        return view('index', [
            'title' => 'Home',
            'categories' => Category::first()->limit(3)->get(),
            'recommendNews' => News::orderByDesc('view_news')->where('status_news', 1)->get(),
            'author_choice' => News::where('author_choice', 1)->where('status_news', 1)->get(),
            'newsByReadingTime' => News::orderByDesc('reading_time')->where('status_news', 1)->get(),
            'latestNews' => News::latest()->limit(3)->where('status_news', 1)->get(),
            'randomNews' => News::inRandomOrder()->limit(6)->where('status_news', 1)->get()
        ]);
    }
}
