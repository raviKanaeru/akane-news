<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // buat request ajax
        if (request()->ajax()) {
            // ambil data user berdasarkan author
            $users = User::where('id', '!=', auth()->user()->id)->get();
            return DataTables::of($users)
                ->addColumn('action', function ($data) {
                    $button = "<button class='edit btn btn-warning' data-toggle='modal' data-target='#userModal' data-placement='top' title='Edit' data-id='" . $data->username . "'><i
                    class='fas fa-pencil-alt'></i></button>";
                    $button .= "<button class='reset btn btn-success ml-1' data-toggle='modal' data-target='#userModal' data-placement='top' title='Reset Password' data-id='" . $data->username . "'><i class='fas fa-key'></i></button>";
                    $button .= "<button class='show-card-profile btn btn-primary mx-1' data-toggle='modal' data-target='#userModal' data-placement='top' title='Show' data-id='" . $data->username . "'><i
                    class='fas fa-eye'></i></button>";
                    $button .= "<button class='delete btn btn-danger' data-toggle='tooltip' data-placement='top' title='Delete' data-id='" . $data->username . "'><i
                    class='fas fa-trash-alt'></i></button>";
                    return $button;
                })->addColumn('status', function ($data) {
                    if ($data->is_admin === 0) {
                        $status = 'Author';
                    } else {
                        $status = 'Admin';
                    };
                    return $status;
                })
                ->rawColumns(['image', 'action'])
                ->make();
        }
        return view('dashboard.users.index', [
            'title' => 'Manage Users'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:7|max:255',
            'password_confirmation' => 'required',
            'image' => 'image|file|max:1024'
        ]);
        // jika validator gagal
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'error' => $validator->errors()]);
        };
        // data yang divalidasi di saring
        $validated = $validator->validated();
        // add image to storage
        if ($request->file('image')) {
            $validated['image'] =  $request->file('image')->store('users-image');
        };
        // convert username ke lowercase
        $validated['username'] = Str::of($request->username)->lower();
        // insert data
        User::create($validated);
        // return message
        return response()->json(['status' => 200, 'message' => 'User has been created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // apakah update data atau reset password
        if ($request->target === 'reset') {
            // buat rules
            $rules = [
                'password' => 'required|confirmed|min:1|max:255',
                'password_confirmation' => 'required',
            ];
            // melakukan validation
            $validator = Validator::make($request->all(), $rules);
            // jika validator gagal
            if ($validator->fails()) {
                return response()->json(['status' => 422, 'error' => $validator->errors()]);
            };
            // data yang divalidasi di saring
            $validated = $validator->validated();
            // hapus confirm password
            unset($validated['password_confirmation']);
            // enkripsi password
            $validated['password'] = Hash::make($validated['password']);
            // update data
            User::where('id', $user->id)->update($validated);
            // kembalikan response
            return response()->json(['status' => 200, 'message' => 'Password has been Changed!']);
        } else {
            // buat rules
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'image' => 'image|file|max:1024'
            ];
            // cek username apakah udah ada
            if ($request->username != $user->username) {
                $rules['username'] = 'required|unique:users';
            };
            // melakukan validation
            $validator = Validator::make($request->all(), $rules);
            // jika validator gagal
            if ($validator->fails()) {
                return response()->json(['status' => 422, 'error' => $validator->errors()]);
            };
            // data yang divalidasi di saring
            $validated = $validator->validated();
            // cek image baru
            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                };
                $validated['image'] = $request->file('image')->store('users-image');
            };
            // update data
            User::where('id', $user->id)->update($validated);
            // kembalikan response
            return response()->json(['status' => 200, 'message' => 'User has been Updated!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // hapus file image
        if ($user->image) {
            Storage::delete($user->image);
        }
        // jalanin eloquent delete
        User::destroy($user->id);
        // kembalikan pesan berhasil
        return response()->json(['status' => 200, 'message' => 'User has been Deleted!']);
    }
}
