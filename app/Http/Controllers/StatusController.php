<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatusController extends Controller
{
    public function index(): View
    {
        $value = Status::latest()->first();
        $formattedUpdatedAt = $value ? $value->formatted_updated_at : null;

        return view('admin.status.index', [
            'title' => 'Adminportalen - Status',
        ], compact('value'));
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
            notify()
                ->success()
                ->title('Status uppdaterad!')
                ->send();

            return redirect()->route('admin.dashboard');
        } else {
            /* Status::create($data); */
            notify()
                ->success()
                ->title('Status skapad!')
                ->send();

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.dashboard');
    }
}
