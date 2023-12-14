<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $categories = Category::query();
            return DataTables::of($categories)
                ->addColumn('action', function ($data) {
                    $button = "<button data-toggle='modal' data-target='#categoryModal' class='edit btn btn-warning mr-2' data-id='" . $data->slug . "'><i
                    class='fas fa-pencil-alt'></i> Edit</button>";
                    $button .= "<button class='delete btn btn-danger' data-id='" . $data->slug . "'><i
                    class='fas fa-trash-alt'></i> Delete</button>";
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
                ->rawColumns(['image', 'action'])
                ->make();
        }
        return view('dashboard.categories.index', [
            'title' => 'Manage Categories'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'image' => 'required|image|file|max:1024'
        ]);
        // jika validator gagal
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()]);
        }
        // data yang divalidasi di saring
        $validated = $validator->validated();
        // add image to storage
        $validated['image'] =  $request->file('image')->store('category-image');
        // insert data
        Category::create($validated);
        // return message
        return response()->json(['status' => 200, 'message' => 'Category has been created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $rules = [
            'name' => 'required|max:50',
            'image' => 'image|file|max:1024'
        ];

        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        // melakukan validation
        $validator = Validator::make($request->all(), $rules);
        // jika validator gagal
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()]);
        }
        // data yang divalidasi di saring
        $validated = $validator->validated();

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('category-image');
        }

        Category::where('id', $category->id)->update($validated);

        return response()->json(['status' => 200, 'message' => 'Category has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // hapus file image
        Storage::delete($category->image);
        // jalanin eloquent delete
        Category::destroy($category->id);
        // kembalikan pesan berhasil
        return response()->json(['status' => 200, 'message' => 'Category has been Deleted!']);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
