<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('member.payments', compact('user'), [
            'title' => 'Medlemsportal - Betalningar',
        ]);
    }
}
