<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\View\View;
use Statamic\Facades\Entry;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $status = Status::latest()->first();
        $formattedUpdatedAt = $status ? $status->formatted_updated_at : null;

        $entries = Entry::query()->where('collection', 'pages')->where('slug', 'home')->get();
        $page = $entries->first();

        return view('home', compact('page', 'status', 'formattedUpdatedAt'));
    }
}
