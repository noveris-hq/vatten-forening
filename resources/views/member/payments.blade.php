@extends('member.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto px-4 py-8">
        <x-greeting :user="$user" />
        <div class="space-y-6">
            <!-- Card wrapper -->
            <div class="rounded-xl">
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="h-fit rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight text-gray-900 dark:text-gray-100">Betalningsstatus</h3>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Översikt över din medlemsavgift</p>
                        </div>
                        <div class="p-6 pt-0 space-y-6">
                            <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-700 space-y-3">
                                <div class="flex items-center justify-between border-b border-gray-300 dark:border-gray-600 pb-3"><span
                                        class="text-gray-700 dark:text-gray-300">Årsavgift 2026</span>
                                    <span class="text-xl font-bold text-gray-900 dark:text-gray-100">2500 kr</span>
                                </div>
                                <div class="flex items-center justify-between"><span class="text-gray-700 dark:text-gray-300">Status</span>
                                    <div
                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 {{ $user->payment_status_color }} hover:bg-secondary/80">
                                        {{ $user->translated_payment_status }}</div>
                                </div>
                                <div class="flex items-center justify-between"><span
                                        class="text-gray-700 dark:text-gray-300">Förfallodatum</span><span class="flex items-center gap-2 text-gray-900 dark:text-gray-100"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-clock h-4 w-4 text-gray-500 dark:text-gray-400">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>2026-03-31</span></div>
                            </div>
                            <div class="p-4 rounded-lg border border-green-200 dark:border-green-700 bg-green-50 dark:bg-green-900/20">
                                <div class="flex items-center gap-2 text-green-900 dark:text-green-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-check-big h-5 w-5 text-green-900 dark:text-green-300">
                                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                        <path d="m9 11 3 3L22 4"></path>
                                    </svg>
                                    <span class="font-medium">Senaste betalning</span>
                                </div>
                                <p class="mt-1 text-sm text-green-600 dark:text-green-400">2025-03-15 - Årsavgift 2025</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 pb-6 space-y-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <!-- Payment methods -->
                        <div class="pt-6 pb-3">
                            <h3 class="text-2xl leading-none tracking-tight font-semibold text-gray-900 dark:text-gray-100">Betalningsinformation</h3>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                Så här betalar du din avgift
                            </p>
                        </div>

                        <div>
                            <!-- Swish -->
                            <div
                                class="p-5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-700/50 hover:bg-white dark:hover:bg-gray-700 transition-colors">
                                <h4 class="font-semibold flex items-center gap-2 mb-3 text-gray-900 dark:text-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-900 dark:text-blue-400" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="M7 8h10M7 12h10" />
                                    </svg>
                                    Swish
                                </h4>
                                <p class="text-2xl font-mono font-bold tracking-wide text-blue-900/90 dark:text-blue-400">
                                    {{ $swish ?? '123 456 78 90' }}
                                </p>
                                <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                                    Ange din fastighetsbeteckning som meddelande
                                </p>
                            </div>
                        </div>

                        <!-- Important notes -->
                        <div class="p-5 rounded-lg bg-gray-100 dark:bg-gray-700">
                            <h4 class="font-medium mb-3 text-gray-900 dark:text-gray-100">Viktigt att tänka på</h4>
                            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                <li class="flex items-start gap-2">
                                    <span class="text-primary mt-0.5">•</span>
                                    <span>Ange alltid fastighetsbeteckning i meddelandet</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-primary mt-0.5">•</span>
                                    <span>Betalningen registreras inom 1–3 bankdagar</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-primary mt-0.5">•</span>
                                    <span>Vid frågor, kontakta styrelsen</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <x-navigation /> --}}
        </div>
    </main>
@endsection
