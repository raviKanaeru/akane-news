<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // buat request ajax
        if (request()->ajax()) {
            // ambil data user berdasarkan author
            $feedbacks = Feedback::latest();
            return DataTables::of($feedbacks)
                ->addColumn('action', function ($data) {
                    $button = "<button class='show-card-profile btn btn-primary mx-1 show-feedback' data-toggle='modal' data-target='#feedbackModal' data-placement='top' title='Show' data-id='" . $data->id . "'><i
                    class='fas fa-eye'></i></button>";
                    $button .= "<button class='delete btn btn-danger' data-toggle='tooltip' data-placement='top' title='Delete' data-id='" . $data->id . "'><i
                    class='fas fa-trash-alt'></i></button>";
                    return $button;
                })
                ->make();
        }
        return view('dashboard.feedback.index', [
            'title' => 'Manage Feedback'
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return response()->json($feedback);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        // jalanin eloquent delete
        Feedback::destroy($feedback->id);
        // kembalikan pesan berhasil
        return response()->json(['status' => 200, 'message' => 'Feedback has been Deleted!']);
    }
}
