<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\View\View;

final class NewsController extends Controller
{
    /**
     * Display the specified news item.
     */
    public function show(News $news): View
    {
        return view('member.news.show', compact('news'), [
            'title' => $news->title,
        ]);
    }
}
