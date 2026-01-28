<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Document;

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
}
