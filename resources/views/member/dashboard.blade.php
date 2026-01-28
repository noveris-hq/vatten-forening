@extends('member.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto px-4 ">
        <x-greeting :user="$user" />
        <div class="space-y-6">
            <x-overview :documents="$documents" :user="$user" :latestNews="$latestNews" :importantNews="$importantNews" />
            {{-- <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm p-6"> --}}
            {{--     <h3 class="text-lg font-semibold mb-4">Livewire Test</h3> --}}
            {{--     <livewire:test-counter /> --}}
            {{-- </div> --}}
        </div>
    </main>
@endsection
