@extends('admin.layout')

<x-dashboard-nav />

@vite(['resources/css/leaflet.css', 'resources/js/leaflet.js', 'resources/js/valve-map.js'])

@section('content')
    <main class="container max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Skapa Vattenventil</h1>

        <form action="{{ route('water-valves.store') }}" method="POST"
            class="bg-white dark:bg-gray-800 rounded border border-gray-300 dark:border-gray-600 px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Välj medlem</label>
                <select name="user_id" id="user_id" required
                    class="dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Välj en medlem...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} - {{ $user->property_number ?? 'Inget fastighetsnummer' }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location_description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    Platsbeskrivning för vattenventil
                </label>
                <textarea name="location_description" id="location_description" rows="3" required
                    class="border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Beskriv var ventilen är placerad...">{{ old('location_description') }}</textarea>
                @error('location_description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="latitude" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Latitud</label>
                    <input type="number" step="any" name="latitude" id="latitude" required
                        value="{{ old('latitude') }}"
                        class="border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="64.330775">
                    @error('latitude')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="longitude" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Longitud</label>
                    <input type="number" step="any" name="longitude" id="longitude" required
                        value="{{ old('longitude') }}"
                        class="border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="15.723076">
                    @error('longitude')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="hidden" name="is_open" value="0">
                    <input type="checkbox" name="is_open" value="1"
                        {{ old('is_open') ? 'checked' : '' }}
                        class="mr-2">
                    <span class="text-gray-700 dark:text-gray-300 text-sm font-bold">Ventilen är öppen</span>
                </label>
                @error('is_open')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Map Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-white">Välj position på karta</h3>
                <div id="coordinate-picker-map" class="h-96 bg-gray-200 rounded border border-gray-300 dark:border-gray-600 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <p class="text-gray-600 dark:text-gray-300">Karta laddar...</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                    Klicka på kartan för att ställa in koordinater, eller fyll i manuellt ovan.
                </p>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-950/80 hover:bg-blue-900/80 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Skapa Vattenventil
                </button>
                <a href="{{ route('admin.map.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Tillbaka till kartan
                </a>
            </div>
        </form>
    </main>
@endsection
