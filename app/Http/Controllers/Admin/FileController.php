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
        $documents = Document::latest()->get();

        $groupedDocuments = $documents
            ->groupBy('year')
            ->sortKeysDesc()
            ->map(function ($yearGroup) {
                return $yearGroup->sortByDesc('created_at');
            });

        $sortedYears = Document::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view(
            'admin.document.index',
            ['title' => 'Admin - Dokumenthantering'],
            compact(
                'groupedDocuments',
                'documents',
                'sortedYears',
            )
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,docx|max:10240', // Max size 10MB
            'category' => 'required|string|max:255',
            'year' => 'required|integer',
        ], [
            'file.required' => 'Vänligen välj en fil att ladda upp.',
            'category.required' => 'Vänligen ange en kategori.',
            'year.required' => 'Vänligen ange ett årtal för detta dokument.',
        ]);

        $fileName = $request->file('file')->getClientOriginalName();

        $file = $request->file('file');
        $path = Storage::disk('local')->putFileAs(
            'documents',
            $file,
            $fileName
        );

        $year = $request->input('year');

        $category = $request->input('category');

        Document::create([
            'title' => $fileName,
            'filename' => $fileName,
            'category' => $category,
            'path' => $path,
            'mime_type' => Storage::mimeType($path),
            'size' => Storage::size($path),
            'uploaded_by' => auth()->id(),
            'year' => $year,
        ]);

        notify()
            ->success()
            ->title('Dokumentet uppladdat!')
            ->send();

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
        } else {
            notify()
                ->warning()
                ->title('Filen hittades!')
                ->send();
        }

        // Delete from database
        $document->delete();

        notify()
            ->success()
            ->title('Dokument raderat!')
            ->send();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'File deleted successfully!');
    }
}
