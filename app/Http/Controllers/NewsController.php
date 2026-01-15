<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('date', 'desc')->paginate(10);

        return view('admin.news.index', [
            'title' => 'Nyheter',
        ], compact('news'));
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'is_important' => 'boolean',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')->with('success', 'Nyhet skapad!');
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
    public function edit(string $id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', [
            'title' => 'Redigera nyhet',
        ], compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'is_important' => 'boolean',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        return redirect()->route('news.index')->with('success', 'Nyhet uppdaterad!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Nyhet raderad!');
    }
}
