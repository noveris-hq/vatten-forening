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
        // Start with base query
        $query = User::query();

        // Apply filter if present
        if ($request->filled('filter')) {
            $query->where('payment_status', $request->input('filter'));
        }

        // Apply search if present (works WITH filter)
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

        /* $filter = $request->input('filter'); */
        /* $filteredUsers = match ($filter) { */
        /*     'paid' => User::where('payment_status', 'paid')->orderBy('name')->paginate(15), */
        /*     'unpaid' => User::where('payment_status', 'unpaid')->orderBy('name')->paginate(15), */
        /*     'overdue' => User::where('payment_status', 'overdue')->orderBy('name')->paginate(15), */
        /*     default => User::orderBy('name')->paginate(15), */
        /* }; */
        /* if ($filter) { */
        /*     $users = $filteredUsers->appends(['filter' => $filter]); */
        /* } else { */
        /*     $users = $filteredUsers; */
        /* } */
        /**/
        /* $searchQuery = $request->input('search'); */
        /* if ($searchQuery) { */
        /*     $users = User::where('name', 'like', '%'.$searchQuery.'%') */
        /*         ->orWhere('email', 'like', '%'.$searchQuery.'%') */
        /*         ->orderBy('name') */
        /*         ->paginate(20) */
        /*         ->appends(['search' => $searchQuery]); */
        /*     if ($users->isEmpty()) { */
        /*         notify()->info()->title('Inga medlemmar hittades för sökningen: '.$searchQuery)->send(); */
        /*     } */
        /* } */
        /* $users = User::orderBy('name')->paginate(15); */

        $totalMembers = User::count();
        $paidMembers = User::where('payment_status', 'paid')->count();
        $unpaidMembers = User::where('payment_status', 'unpaid')->count();
        $overdueMembers = User::where('payment_status', 'overdue')->count();

        return view(
            'admin.users.index',
            compact('users', 'totalMembers', 'paidMembers', 'unpaidMembers', 'overdueMembers'),
            [
                'title' => 'Medlemmar',
            ],
        );
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
        return view(
            'admin.users.edit',
            [
                'title' => 'Redigera medlem',
            ],
            compact('user'),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'payment_status' => 'required|in:paid,unpaid,overdue',
        ]);

        $user->update($validatedData);

        notify()->success()->title('Medlem updaterad!')->send();

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
