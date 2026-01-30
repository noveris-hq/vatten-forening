<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\News;
use App\Models\Status;
use App\Models\User;
use Illuminate\View\View;

final class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $status = Status::latest()->first();

        if (! $status) {
            $status = new Status([
                'status' => 'warning',
                'message' => 'Det finns ingen status tillgänglig för närvarande.',
            ]);
            $status->formatted_updated_at = now()->toDateTimeString();
            $status->updated_at = now();
        }

        $formattedUpdatedAt = $status ? $status->formatted_updated_at : null;

        $news = News::orderBy('created_at', 'desc')->get();

        $documents = Document::latest()->get();

        $memberCount = User::where('is_admin', '0')->count();

        $title = 'Admin Dashboard';

        return view('admin.dashboard', compact(
            'status',
            'documents',
            'news',
            'memberCount',
            'formattedUpdatedAt',
            'title',
        ));
    }
}
