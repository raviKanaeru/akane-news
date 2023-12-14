<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;

class DashboardAccountController extends Controller
{
    public function index()
    {
        return view('dashboard.accounts.index', [
            'title' => 'My Account',
            'user' => User::where('id', auth()->user()->id)->get()->first(),
            'countNews' => News::where('user_id', auth()->user()->id)->count(),
        ]);
    }
}
