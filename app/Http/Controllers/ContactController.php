<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index', [
            'title' => 'Contact Us',
            'categories' => Category::first()->limit(3)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|string',
            'email' => 'required|max:100|email',
            'message' => 'required'
        ]);

        Feedback::create($validate);

        return redirect('/contact')->with('success', 'The message has been sent.');
    }
}
