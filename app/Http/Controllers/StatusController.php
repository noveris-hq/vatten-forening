<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class StatusController extends Controller
{
    public function index(): View
    {
        $value = Status::latest()->first();
        $formattedUpdatedAt = $value ? $value->formatted_updated_at : null;

        $title = 'Adminportalen - Status';

        return view('admin.status.index', compact('value', 'formattedUpdatedAt', 'title'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|string',
            'message' => 'required|string',
        ]);

        $status = Status::latest()->first();

        if ($status) {
            $status->update($data);
            notify()->success()->title('Status uppdaterad!')->send();

            return redirect()->route('admin.dashboard');
        }

        // No existing status, create a new one
        Status::create($data);
        notify()->success()->title('Status skapad!')->send();

        return redirect()->route('admin.dashboard');
    }
}
