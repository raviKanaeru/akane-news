<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class DashboardNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $news = News::where('user_id', auth()->user()->id)->get();

            return DataTables::of($news)
                ->addColumn('action', function ($data) {
                    $button = "<a href='/dashboard/news/$data->slug/edit' data-toggle='tooltip' data-placement='top' title='Edit' class='edit btn btn-warning mr-2'><i
                    class='fas fa-pencil-alt'></i></a>";
                    $button .= "<a href='/dashboard/news/$data->slug' data-toggle='tooltip' data-placement='top' title='Show' class='show btn btn-primary mr-2'><i
                    class='fas fa-eye'></i></a>";
                    $button .= "<button class='delete btn btn-danger' data-toggle='tooltip' data-placement='top' title='Delete' data-id='" . $data->slug . "'><i
                    class='fas fa-trash-alt'></i></button>";
                    return $button;
                })
                ->addColumn('image', function ($data) {
                    if ($data->image) {
                        $image = "<img class='img-fluid' src='" . asset('storage/' . $data->image) . "' width='100' alt='" . $data->name . "'/>";
                    } else {
                        $image = "(Image not found)";
                    }
                    return $image;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status_news === 1) {
                        $status = "<span class='badge badge-success'>Published</span>";
                    } else {
                        $status = "<span class='badge badge-danger'>Save a draft</span>";
                    }
                    return $status;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make();
        }
        return view('dashboard.news.index', [
            'title' => 'Manage News'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.news.create', [
            'title' => 'Create News',
            'categories' => Category::all(),
            'choices' => News::getChoice(),
            'status' => News::getStatus()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:news',
            'category_id' => 'required',
            'reading_time' => 'required|numeric|integer|max:60|min:1',
            'image' => 'image|file|max:1024',
            'body' => 'required',
            'author_choice' => 'required',
            'status_news' => 'required'
        ]);

        if ($request->status_news == 1) {
            $validate['published_at'] = Carbon::now();
        }

        $validate['image'] = $request->file('image')->store('news-image');

        $validate['user_id'] = auth()->user()->id;
        $validate['excerpt'] = Str::limit(strip_tags($request->body, 200));

        News::create($validate);

        return redirect('/dashboard/news')->with('success', 'New news has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('dashboard.news.show', [
            'title' => $news->title,
            'news' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('dashboard.news.edit', [
            'title' => 'Edit News',
            'news' => $news,
            'categories' => Category::all(),
            'choices' => News::getChoice(),
            'status' => News::getStatus()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'reading_time' => 'required|numeric|integer|max:60|min:1',
            'body' => 'required',
            'author_choice' => 'required',
            'status_news' => 'required'

        ];

        if ($request->slug != $news->slug) {
            $rules['slug'] = 'required|unique:news';
        }


        $validate = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validate['image'] = $request->file('image')->store('news-image');
        }
        $validate['user_id'] = auth()->user()->id;
        $validate['excerpt'] = Str::limit(strip_tags($request->body, 200));
        if ($request->status_news == 1 && $news->status_news == 0 && $news->published_at == NULL) {
            $validate['published_at'] = Carbon::now();
        }

        News::where('id', $news->id)->update($validate);

        return redirect('/dashboard/news')->with('success', 'News has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // hapus file image
        Storage::delete($news->image);
        // jalanin eloquent delete
        News::destroy($news->id);
        // kembalikan pesan berhasil
        return response()->json(['status' => 200, 'message' => 'News has been Deleted!']);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(News::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
