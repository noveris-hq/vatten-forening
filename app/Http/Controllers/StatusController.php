<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {

        $value = Status::latest()->first();
        $formattedUpdatedAt = $value ? $value->formatted_updated_at : null;

        return view('admin.status.index', [
            'title' => 'Adminportalen - Status',
        ], compact('value'));
    }

    public function update(Request $request)  // Remove Status $status
    {
        $data = $request->validate([  // Use $request instead of request()
            'status' => 'required|string',
            'message' => 'required|string',
        ]);
        $status = Status::latest()->first();
        if ($status) {
            $status->update($data);

            return redirect()->route('admin.dashboard')->with('success', 'Status uppdaterad!');
        }
        Status::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Status uppdaterad!');
    }
}
