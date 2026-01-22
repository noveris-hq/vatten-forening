@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <div class="min-h-screen antialiased">
        <main class="container mx-auto px-4 py-8">
            <div class=" mx-auto">
                <!-- Welcome -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-foreground">Välkommen till adminpanelen, {{ auth()->user()->name }}
                    </h1>
                    <p class="mt-2 text-gray-600">
                        Här kan du hantera driftstatus, nyheter och dokument för föreningen.
                    </p>
                </div>

                @php
                    $statusIcons = [
                        'ok' => 'check-circle',
                        'warning' => 'exclamation-triangle',
                        'critcal' => 'times-circle',
                    ];
                @endphp

                <!-- Quick Stats -->
                {{-- TODO: fix the issue if there are no status --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-lg border border-gray-300">
                        <div class="flex items-center gap-3 ">
                            @if ($status->status === 'ok')
                                <div class="p-2 rounded-lg bg-green-500/10">
                                    <svg class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @elseif ($status->status === 'warning')
                                <div class="p-2 rounded-lg bg-yellow-500/10">
                                    <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @elseif ($status->status === 'critical')
                                <div class="p-2 rounded-lg bg-red-500/10">
                                    <svg class="h-5 w-5 text-red-600" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="15" y1="9" x2="9" y2="15" />
                                        <line x1="9" y1="9" x2="15" y2="15" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                {{-- TODO: fix the issue if there are no status --}}
                                <p class="text-2xl font-bold text-foreground">
                                    {{ ucfirst($status['status']) }}
                                    {{-- {{ $status['status'] === 'ok' ? 'OK' : ($status['status'] === 'warning' ? '⚠️' : '❌') }} --}}
                                </p>
                                <p class="text-sm text-gray-600">Driftstatus</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg border border-gray-300">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-blue-500/10">
                                <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8l-5 5v13a2 2 0 0 0 2 2z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-foreground">{{ count($news) }}</p>
                                <p class="text-sm text-gray-600">Nyheter</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-lg border border-gray-300">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-purple-500">
                                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-foreground">{{ $memberCount }}</p>
                                <p class="text-sm text-gray-600">Medlemmar</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inline Status Editor -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Redigera Driftstatus</h2>
                    <form action="{{ route('status.update') }}" method="POST" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @method('PUT')
                        <!-- Status indicators -->
                        <div class="space-y-4">

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($status->status === 'ok') name="status" value="ok"
                                    class="h-5 w-5 text-green-600 border-gray-300 focus:ring-green-500">
                                <div>
                                    <div class="font-medium text-green-700">Allt fungerar</div>
                                    <div class="text-sm text-gray-600">Inga kända problem</div>
                                </div>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($status->status === 'warning') name="status" value="warning"
                                    class="h-5 w-5 text-amber-600 border-gray-300 focus:ring-amber-500">
                                <div>
                                    <div class="font-medium text-amber-700">Driftsstörning</div>
                                    <div class="text-sm text-gray-600">Pågående problem som påverkar systemet</div>
                                </div>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" @checked($status->status === 'critical') name="status" value="critical"
                                    class="h-5 w-5 text-red-600 border-gray-300 focus:ring-red-500">
                                <div>
                                    <div class="font-medium text-red-700">Avbrott</div>
                                    <div class="text-sm text-gray-600">Kritiskt fel - vattnet är avstängt</div>
                                </div>
                            </label>

                        </div>

                        <div class="mt-8">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="message">
                                Statusmeddelande
                            </label>
                            <textarea name="message" id="message" rows="4"
                                class="shadow appearance-none border rounded border-gray-200 w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"
                                required>{{ old('content', $status->message) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs italic">{{ $status->message }}</p>
                            @enderror

                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                Detta meddelande visas på startsidan för alla besökare.
                            </p>
                        </div>

                        <button type="submit"
                            class="mt-6 inline-flex items-center px-4 py-2 bg-blue-900/90 border border-transparent hover:cursor-pointer rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Spara ändringar
                        </button>

                    </form>
                    <!-- Last updated -->
                    <div class="mt-6 text-sm text-gray-500">
                        Senast uppdaterad: {{ $status->formattedUpdatedAt }}
                    </div>

                </div>
            </div>
        </main>

    </div>
@endsection
