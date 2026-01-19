<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FileController extends Controller
{
    public function index(): View
    {
        $documents = Document::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.document.index', [
            'title' => 'Filuppladdning',
            compact('documents'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,docx|max:10240', // Max size 10MB
            'category' => 'string|max:255',
        ]);

        $fileName = $request->file('file')->getClientOriginalName();

        $file = $request->file('file');
        $path = Storage::disk('local')->putFileAs(
            'documents',
            $file,
            $fileName
        );

        $category = $request->input('category');

        Document::create([
            'title' => $fileName,
            'filename' => $fileName,
            'category' => $category,
            'path' => $path,
            'mime_type' => Storage::mimeType($path),
            'size' => Storage::size($path),
            'uploaded_by' => auth()->id(),
            'description' => null,
            /* 'members_only' => true, */
        ]);

        return redirect()
            ->route('admin.dashboard', compact('fileName'))
            ->with('success', 'Fil uppladdad: '.$fileName);
    }

    public function download(Document $document)
    {
        // Check if file exists
        if (! Storage::disk('local')->exists($document->path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('local')->download($document->path, $document->filename);
    }

    public function destroy(Document $document): RedirectResponse
    {
        // Delete file from storage
        if (Storage::disk('local')->exists($document->path)) {
            Storage::disk('local')->delete($document->path);
        }

        // Delete from database
        $document->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'File deleted successfully!');
    }
}
