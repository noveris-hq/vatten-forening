<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FileController extends Controller
{
    public function index(): View
    {
        return view('admin.upload.index', [
            'title' => 'Filuppladdning',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,docx|max:10240', // Max size 10MB
        ]);

        $fileName = $request->file('file')->getClientOriginalName();

        $file = $request->file('file');
        $path = Storage::disk('local')->putFileAs(
            'uploads',
            $file,
            $fileName
        );
        $size = Storage::size($path);
        $mime = Storage::mimeType($path);
        /* dd($fileName, $mime, $path, $size); */

        return redirect()
            ->route('admin.upload.index', compact('fileName', 'mime', 'path', 'size', 'file'))
            ->with('success', 'Fil uppladdad: '.$fileName);
    }
}
