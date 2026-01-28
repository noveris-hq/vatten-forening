@props(['importantNews' => null, 'latestNews' => collect(), 'documents' => collect(), 'user' => null])
<!-- Viktiga meddelanden -->
@if ($importantNews)
    <div class="rounded-lg border border-sky-200 dark:border-sky-700 bg-sky-50 dark:bg-sky-900/20">
        <div class="flex flex-col space-y-1.5 p-6 pb-3">
            <h3 class="font-semibold tracking-tight text-lg flex items-center gap-2 text-gray-900 dark:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bell h-5 w-5 text-blue-900 dark:text-blue-400">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                </svg>Viktiga meddelanden
            </h3>
        </div>
        <div class="p-6 pt-0 space-y-3">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $importantNews->title }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $importantNews->content }}</p>
                    </div>
                    <div
                        class="inline-flex items-center rounded-full border border-gray-200 dark:border-gray-700 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-gray-900 dark:text-gray-100 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar h-3 w-3 mr-1">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>{{ $importantNews->date->format('Y-m-d') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif ($latestNews->isEmpty())
    <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Inga nyheter</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Det finns inga viktiga meddelanden för tillfället.</p>
        </div>
    </div>
@endif

<div class="grid gap-6 md:grid-cols-2">
    <!-- Senaste nyheterna -->
    <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="p-6 pb-3">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Senaste nytt</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Nyheter och information från styrelsen</p>
        </div>
        <div class="px-6
                 pb-6 space-y-4">
            @if ($latestNews->isEmpty())
                <p class="text-sm text-gray-900 dark:text-gray-100">Det finns inga nyheter för tillfället.</p>
            @endif
            @foreach ($latestNews as $news)
                <a href="{{ route('member.news.show', $news) }}"
                    class="hover:cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition-colors">
                    <div
                        class="flex items-start mt-3 gap-3 pb-3 border-b border-gray-200 dark:border-gray-700 last:border-0 last:pb-0 hover:cursor-pointer">
                        {{-- <div class="h-2 w-2 rounded-full bg-primary mt-2 shrink-0"></div> --}}
                        {{-- <div class='h-2 w-2 mt-2 shrink-0 bg-blue-900/70 rounded-full transition-colors'></div> --}}
                        <div
                            class="flex-1 min-w-0 hover:bg-slate-50 dark:hover:bg-gray-700/50 rounded-lg transition-colors p-3">
                            <div class="flex items-center gap-2">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $news->title }}
                                </h4>
                                @if ($news->is_important)
                                    <span
                                        class="inline-flex items-center rounded-lg bg-blue-900/10 dark:bg-blue-400/20 text-blue-900 dark:text-blue-300 font-bold px-1.5 py-0.5 text-xs">Viktigt</span>
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" <a href="{{ route('member.news.show', $news) }}" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-chevron-right h-4 w-4 text-gray-500 dark:text-gray-400 shrink-0 mt-1 ml-auto">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>

                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                {{ $news->date->format('Y-m-d') }}
                            </p>
                            {{-- TODO: Show full content or link to full news article --}}
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                                {{ Str::limit($news->content, 100, '...') }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Betalningsstatus -->
    <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="p-6 pb-3">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Medlemsavgift 2026</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Status för din årsavgift</p>
        </div>
        <div class="px-6 pb-6 space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-400">Status</span>
                <span
                    class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-900/30 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:text-green-300">{{ $user->translated_payment_status }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-600 dark:text-gray-400">Förfallodatum</span>
                <span class="font-medium text-gray-900 dark:text-gray-100">2026-01-31</span>
            </div>
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
                <span class="text-gray-600 dark:text-gray-400">Belopp</span>
                <span class="font-medium text-gray-900 dark:text-gray-100">1 200 SEK</span>
            </div>
            <a href="{{ route('member.payments') }}"
                class="bg-blue-900/90 hover:cursor-pointer mt-6 text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-credit-card h-4 w-4">
                    <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                    <line x1="2" x2="22" y1="10" y2="10"></line>
                </svg>

                Gå till betalning
            </a>
        </div>
    </div>
</div>
<!-- Senaste dokument -->
<div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="font-semibold tracking-tight text-lg text-gray-900 dark:text-gray-100">Senaste dokumenten</h3>
        <p class="text-sm text-gray-600 dark:text-gray-300">Nyligen uppladdade dokument</p>
    </div>
    @if (empty($documents))
        <p class="text-sm text-gray-900 dark:text-gray-100">Inga dokument har laddats upp ännu.</p>
    @endif
    <div class="p-6 pt-0">
        @foreach ($documents as $document)
            <div class="space-y-1">
                <div
                    class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-file-text h-5 w-5 text-blue-900 dark:text-blue-400">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                            <path d="M10 9H8"></path>
                            <path d="M16 13H8"></path>
                            <path d="M16 17H8"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-sm text-gray-900 dark:text-gray-100">{{ $document->title }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ Str::ucfirst($document->updated_at->isoFormat('dddd, D MMMM YYYY')) }}</p>
                        </div>
                    </div>
                    <a href="{{ route('member.documents.download', $document->id) }}">
                        <button
                            class="hover:cursor-pointer inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100 h-9 rounded-md px-3 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-download h-4 w-4">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" x2="12" y1="15" y2="3"></line>
                            </svg><span class="hidden sm:inline">Ladda ner</span>
                        </button>
                    </a>
                </div>
            </div>
        @endforeach
        <a href="{{ route('member.documents') }}"
            class="bg-blue-900/90 hover:cursor-pointer mt-6 text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
            Visa alla dokument<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </a>
    </div>
</div>
