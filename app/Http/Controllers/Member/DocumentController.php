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

        return view(
            'member.documents',
            [
                'title' => 'Medlemsportal - Dokument',
            ],
            compact('documents', 'groupedDocuments'),
        );
    }
}
