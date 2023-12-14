<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Category;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' in ' . $author->name;
        }

        return view('news.index', [
            'title' => 'All News ' . $title,
            'categories' => Category::first()->limit(3)->get(),
            "news" => News::latest()->filter(request(['search', 'author', 'category']))->paginate(6)->withQueryString()
        ]);
    }
    public function show(News $news)
    {
        if ($news && session()->get('news_slug')) {
            $news->increment('view_news');
            session()->put('news_slug', $news->slug);
        }
        return view('news.page', [
            'title' => $news->title,
            'categories' => Category::all(),
            'latestNews' => News::latest()->limit(3)->get(),
            'news' => $news
        ]);
    }
}
