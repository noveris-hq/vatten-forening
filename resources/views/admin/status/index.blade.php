@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto px-4 py-8">
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                <h1 class="text-2xl font-bold mb-6">Status</h1>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <form action="{{ route('status.update') }}" method="POST" class="bg-white dark:bg-gray-800 rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @method('PUT')
                        <!-- Status indicators -->
                        <div class="space-y-4">

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($value->status === 'ok') name="status" value="ok"
                                    class="h-5 w-5 text-green-600 dark:text-green-400 border-gray-300 dark:border-gray-600 focus:ring-green-500">
                                <div>
                                    <div class="font-medium text-green-700 dark:text-green-300">Allt fungerar</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Inga kända problem</div>
                                </div>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($value->status === 'warning') name="status" value="warning"
                                    class="h-5 w-5 text-amber-600 dark:text-amber-400 border-gray-300 dark:border-gray-600 focus:ring-amber-500">
                                <div>
                                    <div class="font-medium text-amber-700 dark:text-amber-300">Driftsstörning</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Pågående problem som påverkar systemet</div>
                                </div>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($value->status === 'critical') name="status" value="critical"
                                    class="h-5 w-5 text-red-600 dark:text-red-400 border-gray-300 dark:border-gray-600 focus:ring-red-500">
                                <div>
                                    <div class="font-medium text-red-700 dark:text-red-300">Avbrott</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Kritiskt fel - vattnet är avstängt</div>
                                </div>
                            </label>

                        </div>

                        <div class="mt-8">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="message">
                                Statusmeddelande
                            </label>
                            <textarea name="message" id="message" rows="4"
                                class="shadow appearance-none border rounded border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('content', $value->message) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs italic">{{ $value->message }}</p>
                            @enderror

                            {{-- <textarea name="message" rows="1" --}}
                            {{--     class="shadow appearance-none border rounded w-full border-gray-200 dark:border-gray-700 py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline"> --}}
                            {{--     {{ $value->message }} --}}
                            {{-- </textarea> --}}
                            @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Detta meddelande visas på startsidan för alla besökare.
                            </p>
                        </div>

                        <button type="submit"
                            class="mt-6 inline-flex items-center px-4 py-2 bg-blue-900/90 border border-transparent hover:cursor-pointer rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Spara ändringarsdasdas
                        </button>

                    </form>
                    <!-- Last updated -->
                    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                        Senast uppdaterad: {{ $value->formattedUpdatedAt }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
