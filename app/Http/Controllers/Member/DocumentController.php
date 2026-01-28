<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

final class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();

        $groupedDocuments = $documents
            ->groupBy('year')
            ->sortKeysDesc()
            ->map(function ($yearGroup) {
                return $yearGroup->sortByDesc('created_at');
            });

        $title = 'Medlemsportal - Dokument';

        return view('member.documents', compact('documents', 'groupedDocuments', 'title'));
    }

    public function download(Document $document)
    {
        // Check if file exists
        if (! Storage::disk('local')->exists($document->path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('local')->download($document->path, $document->filename);
    }
}
