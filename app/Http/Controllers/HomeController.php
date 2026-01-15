<?php

namespace App\Http\Controllers;

use Statamic\Facades\Entry;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $entries = Entry::query()->where('collection', 'pages')->where('slug', 'home')->get();
        $page = $entries->first();

        return view('home', compact('page'));
    }
}
