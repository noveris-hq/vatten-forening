<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WaterValveRequest;
use App\Models\WaterValve;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class AdminMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $context = 'admin';
        $searchQuery = $request->input('search');

        if (! $searchQuery) {
            $searchQuery = '';
        }

        $waterValves = WaterValve::with('user')->when($searchQuery, function ($query, $searchQuery) {
            $query->whereHas('user', function ($q) use ($searchQuery) {
                $q
                    ->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('property_number', 'like', "%{$searchQuery}%")
                    ->orWhere('street_name', 'like', "%{$searchQuery}%");
            });
        })->get();

        $mapCenter = [
            'lat' => 64.33077538985226,
            'lng' => 15.723075866929708,
        ];

        $markers = $waterValves->map(fn ($valve) => [
            'lat' => $valve->latitude,
            'lng' => $valve->longitude,
            'name' => $valve->user?->name,
            'location_description' => $valve->location_description,
            'is_open' => $valve->is_open,
            'street_name' => $valve->user?->street_name,
            'property_number' => $valve->user?->property_number,
        ])->toArray();

        $title = 'Karta över området';

        return view('admin.map.index', compact('waterValves', 'markers', 'mapCenter', 'context', 'title'));
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
    public function store(WaterValveRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Check if user already has a water valve
        $existingValve = WaterValve::where('user_id', $validated['user_id'])->first();

        if ($existingValve) {
            return redirect()
                ->route('admin.map.index')
                ->with('error', 'Användaren har redan en vattenventil tilldelad.');
        }

        $waterValve = WaterValve::create($validated);

        notify()->success()->title('Vattenventil har skapats och tilldelats till '.$waterValve->user->name)->send();

        return redirect()->route('admin.map.index');
    }
}
