<div class="space-y-3">
    @foreach ($groupedDocuments as $year => $docs)
        <h3 class="mt-6 mb-2 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $year }}</h3>
        @foreach ($docs as $doc)
            <div
                class="flex flex-col gap-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-3">
                    <!-- File icon -->
                    <div class="mt-0.5 rounded-md bg-gray-100 dark:bg-gray-700 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <div>
                        <p class="font-medium leading-tight text-gray-900 dark:text-gray-100">{{ $doc->filename }}</p>
                        <div
                            class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-600 dark:text-gray-400">
                            @if ($doc->uploader)
                                <span>Uppladdad av: {{ $doc->uploader->name }}</span>
                            @endif

                            @if (isset($translation[$doc->category]))
                                <span
                                    class="inline-flex items-center rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-2 py-0.5 text-xs font-medium text-gray-900 dark:text-gray-100">
                                    {{ $translation[$doc->category] }}
                                </span>
                            @endif
                            <span>Uppladdad {{ $doc->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.document.download', $doc) }}"
                        class="inline-flex items-center gap-1.5 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-sm font-medium text-gray-900 dark:text-gray-100 shadow-sm transition-colors hover:bg-gray-100 dark:hover:bg-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Ladda ner
                    </a>

                    @if (auth()->user()?->is_admin)
                        <form action="{{ route('admin.document.destroy', $doc) }}" method="POST" class="inline"
                            onsubmit="return confirm('Är du säker på att du vill ta bort {{ $doc->filename }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:cursor-pointer bg-red-100 dark:bg-red-900/30 px-3 py-1.5 rounded-md">
                                Ta bort
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endforeach
</div>
