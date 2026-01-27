<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class AdminNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $news = News::orderBy('date', 'desc')->paginate(10);

        return view(
            'admin.news.index',
            [
                'title' => 'Nyheter',
            ],
            compact('news'),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create', [
            'title' => 'Skapa nyhet',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'is_important' => 'boolean',
        ]);

        News::create($request->all());

        notify()->success()->title('Nyhet skapad!')->send();

        return redirect()->route('nyheter.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $news = News::findOrFail($id);

        return view(
            'admin.news.edit',
            [
                'title' => 'Redigera nyhet',
            ],
            compact('news'),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'is_important' => 'boolean',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        notify()->success()->title('Nyhet updaterad!')->send();

        return redirect()->route('nyheter.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        $news->delete();

        notify()->success()->title('Nyhet raderad!')->send();

        return redirect()->route('news.index');
    }
}
