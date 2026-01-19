<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();

        return view('member.documents', [
            'title' => 'Medlemsportal - Dokument',
        ], compact('documents'));
    }
}
