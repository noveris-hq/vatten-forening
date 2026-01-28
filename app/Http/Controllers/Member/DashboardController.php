<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\News;
use Illuminate\View\View;

final class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = auth()->user();

        $latestNews = News::orderBy('date', 'desc')->take(2)->get();
        $importantNews = News::where('is_important', true)->orderBy('date', 'desc')->first();
        $documents = Document::orderBy('created_at', 'desc')->take(3)->get();

        $title = 'Medlemsportal';

        return view('member.dashboard', compact('documents', 'user', 'latestNews', 'importantNews', 'title'));
    }
}
