<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function index()
    {
        return view('member.documents', [
            'title' => 'Medlemsportal - Dokument',
        ]);
    }
}
