<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
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

        /* $status = [ */
        /*     'status' => 'operational', */
        /*     'message' => 'Vattensystemet fungerar normalt. Inga pågående driftstörningar.', */
        /*     'lastUpdated' => '8 januari 2026, kl. 08:00', */
        /* ]; */

        $news = News::orderBy('created_at', 'desc')->get();

        $documents = [
            [
                'id' => '1',
                'name' => 'Stadgar för Västra Karbäckens vattenförening',
                'type' => 'stadgar',
                'year' => '2024',
                'uploadedAt' => '2024-03-20',
            ],
            [
                'id' => '2',
                'name' => 'Årsmötesprotokoll 2025',
                'type' => 'protokoll',
                'year' => '2025',
                'uploadedAt' => '2025-03-18',
            ],
            [
                'id' => '3',
                'name' => 'Årsmötesprotokoll 2024',
                'type' => 'protokoll',
                'year' => '2024',
                'uploadedAt' => '2024-03-22',
            ],
        ];

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
