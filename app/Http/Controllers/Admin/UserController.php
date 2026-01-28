<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Apply filter if present
        if ($request->filled('filter')) {
            $query->where('payment_status', $request->input('filter'));
        }

        // Apply search if present
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q
                    ->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->orWhere('phone', 'like', "%{$searchTerm}%");
            });
        }

        $users = $query->orderBy('name')->paginate(15)->appends($request->query());

        $totalMembers = User::count();
        $paidMembers = User::where('payment_status', 'paid')->count();
        $unpaidMembers = User::where('payment_status', 'unpaid')->count();
        $overdueMembers = User::where('payment_status', 'overdue')->count();

        $title = 'Medlemmar';

        return view('admin.users.index', compact(
            'users',
            'totalMembers',
            'paidMembers',
            'unpaidMembers',
            'overdueMembers',
            'title',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Redigera medlem';

        return view('admin.users.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'property_number' => 'nullable|string|max:50',
            'street_name' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'payment_status' => 'required|in:paid,unpaid,overdue',
        ]);

        $user->update($validatedData);

        // Handle water valve data if present
        if ($request->has(['location_description', 'latitude', 'longitude'])) {
            $valveData = $request->validate([
                'location_description' => 'required|string|max:255',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'is_open' => 'boolean',
            ]);

            // Create or update water valve for this user
            $waterValve = $user->waterValves ?? new WaterValve;
            $waterValve->user_id = $user->id;
            $waterValve->fill($valveData);
            $waterValve->save();
        }

        notify()->success()->title('Medlem uppdaterad!')->send();

        return redirect()->route('medlemmar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
