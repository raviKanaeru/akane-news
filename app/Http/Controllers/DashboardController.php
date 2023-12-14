<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'newsCount' => News::count(),
            'categoryCount' => Category::count(),
            'userCount' => User::count(),
            'userFeedback' => Feedback::count(),
            'recentNews' => News::latest()->limit(5)->where('user_id', auth()->user()->id)->get()
        ]);
    }
}
