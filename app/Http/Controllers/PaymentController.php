<?php

namespace App\Http\Controllers;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('member.payments', compact('user'), [
            'title' => 'Medlemsportal - Betalningar',
        ]);
    }
}
