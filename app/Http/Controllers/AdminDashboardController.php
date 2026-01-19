<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\News;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        /**
         * !TODO: Replace hardcoded status with dynamic data from database
         * i dont want the status to be editable from the statamic cms
         */

        // Later: fetch from database
        $status = Status::latest()->first();
        $formattedUpdatedAt = $status ? $status->formatted_updated_at : null;

        $news = News::orderBy('created_at', 'desc')->get();

        $documents = Document::latest()->get();

        $memberCount = User::where('is_admin', '0')->count();

        return view('admin.dashboard', compact('status', 'documents', 'news', 'memberCount', 'formattedUpdatedAt'), [
            'title' => 'Admin Dashboard',
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
