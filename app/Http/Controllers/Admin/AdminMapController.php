<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaterValve;
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

        return view(
            'admin.map.index',
            [
                'title' => 'Admin Karta över området',
            ],
            compact('waterValves', 'markers', 'mapCenter', 'context'),
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
    public function show(User $user, Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
