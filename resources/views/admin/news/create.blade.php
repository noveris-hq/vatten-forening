@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-2xl dark:text-white font-bold mb-6">Skapa nyhet</h1>

        <form action="{{ route('nyheter.store') }}" method="POST"
            class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Titel</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="border dark:border-gray-700 border-gray-200 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Innehåll</label>
                <textarea name="content" id="content" rows="4"
                    class=" border dark:border-gray-700 border-gray-200 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Datum</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}"
                    class="border dark:border-gray-700 border-gray-200 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @error('date')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_important" value="1" {{ old('is_important') ? 'checked' : '' }}
                        class="mr-2">
                    <span class="text-gray-700 dark:text-gray-300 text-sm font-bold">Viktig nyhet</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-900/90 hover:cursor-pointer mt-6 text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Skapa nyhet
                </button>
                <a href="{{ route('nyheter.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Tillbaka
                </a>
            </div>
        </form>
    </main>
@endsection
