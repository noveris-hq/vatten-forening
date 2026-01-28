@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <div class="min-h-screen antialiased">
        <main class="container mx-auto px-4 py-8">
            <div class=" mx-auto">
                <!-- Welcome -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Välkommen till adminpanelen,
                        {{ auth()->user()->name }}
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Här kan du hantera driftstatus, nyheter och dokument för föreningen.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4 dark:text-white">Redigera Driftstatus</h2>
                    <form action="{{ route('status.update') }}" method="POST"
                        class="bg-white dark:bg-gray-800 rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @method('PUT')
                        <!-- Status indicators -->
                        <div class="space-y-4">

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($status->status === 'ok') name="status" value="ok"
                                    class="h-5 w-5 text-green-600 dark:text-green-400 border-gray-300 dark:border-gray-600 focus:ring-green-500">
                                <div>
                                    <div class="font-medium text-green-700 dark:text-green-300">Allt fungerar</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Inga kända problem</div>
                                </div>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($status->status === 'warning') name="status" value="warning"
                                    class="h-5 w-5 text-amber-600 dark:text-amber-400 border-gray-300 dark:border-gray-600 focus:ring-amber-500">
                                <div>
                                    <div class="font-medium text-amber-700 dark:text-amber-300">Driftsstörning</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Pågående problem som påverkar
                                        systemet</div>
                                </div>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($status->status === 'critical') name="status" value="critical"
                                    class="h-5 w-5 text-red-600 dark:text-red-400 border-gray-300 dark:border-gray-600 focus:ring-red-500">
                                <div>
                                    <div class="font-medium text-red-700 dark:text-red-300">Avbrott</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">Kritiskt fel - vattnet är avstängt
                                    </div>
                                </div>
                            </label>

                        </div>

                        <div class="mt-8">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" for="message">
                                Statusmeddelande
                            </label>
                            <textarea name="message" id="message" rows="4"
                                class="shadow appearance-none border rounded border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('content', $status->message) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs italic">{{ $status->message }}</p>
                            @enderror

                            @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Detta meddelande visas på startsidan för alla besökare.
                            </p>
                        </div>

                        <button type="submit"
                            class="bg-blue-900/90 hover:cursor-pointer mt-6 text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            Spara ändringar
                        </button>

                    </form>
                    <!-- Last updated -->
                    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                        Senast uppdaterad: {{ $status->formattedUpdatedAt }}
                    </div>

                </div>
            </div>
        </main>

    </div>
@endsection
