<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaterValveRequest;
use App\Models\User;
use App\Models\WaterValve;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class WaterValveController extends Controller
{
    /**
     * Show the form for creating a new water valve.
     */
    public function create(): View
    {
        $users = User::orderBy('name')->get();
        $title = 'Skapa vattenventil';

        return view('admin.water-valves.create', compact('users', 'title'));
    }

    /**
     * Store a newly created water valve in storage.
     */
    public function store(WaterValveRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Check if user already has a water valve
        $existingValve = WaterValve::where('user_id', $validated['user_id'])->first();

        if ($existingValve) {
            notify()->error()->title('Användaren har redan en vattenventil tilldelad')->send();

            return redirect()->back();
        }

        $waterValve = WaterValve::create($validated);

        notify()->success()->title('Vattenventil har skapats och tilldelats till '.$waterValve->user->name)->send();

        return redirect()->route('admin.map.index');
    }

    /**
     * Show the form for editing the specified water valve.
     */
    public function edit(WaterValve $waterValve): View
    {
        $users = User::orderBy('name')->get();
        $title = 'Redigera vattenventil';

        return view('admin.water-valves.edit', compact('waterValve', 'users', 'title'));
    }

    /**
     * Update the specified water valve in storage.
     */
    public function update(WaterValveRequest $request, WaterValve $waterValve): RedirectResponse
    {
        $validated = $request->validated();

        // Check if another user already has this water valve
        $existingValve = WaterValve::where('user_id', $validated['user_id'])
            ->where('id', '!=', $waterValve->id)
            ->first();

        if ($existingValve) {
            notify()->error()->title('Den valda användaren har redan en vattenventil tilldelad')->send();

            return redirect()->back();
        }

        $waterValve->update($validated);

        notify()->success()->title('Vattenventil har uppdaterats för '.$waterValve->user->name)->send();

        return redirect()->route('admin.map.index');
    }

    /**
     * Remove the specified water valve from storage.
     */
    public function destroy(WaterValve $waterValve): RedirectResponse
    {
        $waterValve->delete();

        notify()->success()->title('Vattenventil har tagits bort för '.$waterValve->user->name)->send();

        return redirect()->route('admin.map.index');
    }
}
