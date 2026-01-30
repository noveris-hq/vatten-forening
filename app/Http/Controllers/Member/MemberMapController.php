<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaterValve;
use Illuminate\Http\Request;

final class MemberMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = 'member';

        $mapCenter = [
            'lat' => 64.33077538985226,
            'lng' => 15.723075866929708,
        ];

        $waterValves = WaterValve::with('user')->get();

        if ($waterValves->isEmpty()) {
            return view('member.map', [
                'waterValves' => collect(),
                'markers' => [],
                'mapCenter' => $mapCenter,
                'title' => 'Karta över området',
                'context' => $context,
            ]);
        }

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

        return view('member.map', compact('waterValves', 'markers', 'mapCenter', 'title', 'context'));
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
