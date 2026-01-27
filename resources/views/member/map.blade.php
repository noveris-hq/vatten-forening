@extends('member.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto pb-8">
        <div class="mx-auto">
            <x-valve-map :waterValves="$waterValves" :markers="$markers" :mapCenter="$mapCenter" />
            <x-valve-map-table :waterValves="$waterValves" />
        </div>
    </main>
@endsection
