<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = auth()->user();

        // Placeholder data - replace with real data later
        $balance = 1200; // Placeholder

        $latestNews = News::orderBy('date', 'desc')->take(3)->get();
        $importantNews = News::where('is_important', true)->orderBy('date', 'desc')->first();
        $documents = Document::orderBy('created_at', 'desc')->take(5)->get();

        return view('member.dashboard', compact('documents', 'user', 'balance', 'latestNews', 'importantNews'), [
            'title' => 'Medlemsportal',
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
