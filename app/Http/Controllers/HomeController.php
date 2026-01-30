<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\View\View;
use Statamic\Facades\Entry;

final class HomeController extends Controller
{
    /**
     * Display the home page.
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

        // Fetch the 'home' page entry from the 'pages' collection in Statamic
        $entries = Entry::query()
            ->where('collection', 'pages')
            ->where('slug', 'home')
            ->get();
        $page = $entries->first();

        return view('home', compact('page', 'status', 'formattedUpdatedAt'));
    }
}
