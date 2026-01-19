@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <div class="min-h-screen antialiased">
        <main class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
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

                <!-- Tabs with Alpine.js -->
                <div x-data="{ activeTab: 'status' }" class="space-y-6">
                    <!-- Tabs List -->
                    <div
                        class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground w-full">
                        <button @click="activeTab = 'status'"
                            :class="{ 'bg-background shadow-sm text-foreground': activeTab === 'status' }"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2v20M2 12h20" />
                            </svg>
                            <span class="hidden sm:inline">Driftstatus</span>
                        </button>

                        <button @click="activeTab = 'news'"
                            :class="{ 'bg-background text-foreground': activeTab === 'news' }"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8l-5 5v13a2 2 0 0 0 2 2z" />
                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            </svg>
                            <span class="hidden sm:inline">Nyheter</span>
                        </button>

                        <button @click="activeTab = 'documents'"
                            :class="{ 'bg-background shadow-sm text-foreground': activeTab === 'documents' }"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <path d="M14 2v6h6" />
                            </svg>
                            <span class="hidden sm:inline">Dokument</span>
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div x-show="activeTab === 'status'" class="bg-card p-6 rounded-xl border border-gray-300">
                        <!-- Here goes your StatusManager content -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold">Nuvarande status</h3>
                            <div class="p-4 bg-gray-100 rounded-lg">
                                <p class="font-medium">{{ $status['message'] }}</p>
                                <p class="text-sm text-muted-foreground mt-2">Uppdaterad: {{ $status->formattedUpdatedAt }}
                                </p>
                            </div>
                            <a href="{{ route('status.index') }}"
                                class="text-sm text-blue-500 hover:underline mt-2 inline-block">Redigera status</a>
                            <!-- Add form / manager UI here later -->
                        </div>
                    </div>

                    <div x-show="activeTab === 'news'" class="bg-card p-6 rounded-xl border border-gray-300">
                        <!-- News list / manager -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold">Nyheter ({{ count($news) }} st)</h3>
                            <a href="{{ route('news.index') }}"
                                class="text-sm text-blue-500 hover:underline mt-2 inline-block">Hantera nyheter</a>
                            @foreach ($news as $item)
                                <div class="border-b pb-4 last:border-0 last:pb-0">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="font-medium">{{ $item['title'] }}</h4>
                                            @if ($item['isImportant'])
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 mt-1 rounded text-xs font-medium bg-red-100 text-red-800">Viktigt</span>
                                            @endif
                                            <p class="text-sm text-muted-foreground mt-1">{{ $item['content'] }}</p>
                                        </div>
                                        <span
                                            class="text-xs text-muted-foreground whitespace-nowrap">{{ $item['created_at'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add create/edit form here -->
                        </div>
                    </div>


                    @php
                        $translation = $documents;
                        $translation = [
                            'yearly-rapport' => 'Årsrapport',
                            'protocoll' => 'Protokoll',
                            'invoices' => 'Faktura',
                        ];
                    @endphp

                    <div x-show="activeTab === 'documents'" class="bg-card p-6 rounded-xl border border-gray-300">
                        <!-- Documents list / manager -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold">Dokument ({{ $documents->count() }} st)</h3>
                            <a href="{{ route('admin.document.index') }}"
                                class="text-sm text-blue-500 hover:underline mt-2 inline-block">Hantera dokument</a>
                            @if ($documents->isEmpty())
                                <p class="text-sm text-muted-foreground">Inga dokument uppladdade än.</p>
                            @else
                                @foreach ($documents as $doc)
                                    <div class="flex items-center justify-between p-3 rounded-lg border hover:bg-muted/50">
                                        <div class="flex items-center gap-3">
                                            <svg class="h-5 w-5 text-muted-foreground" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <path d="M14 2v6h6" />
                                            </svg>
                                            <div>
                                                <p class="font-medium">{{ $doc->filename }}</p>
                                                <p class="text-sm text-muted-foreground mt-0.5">
                                                    Uppladdad av: {{ $doc->uploader->name }}
                                                </p>
                                                <div class="flex gap-2 text-xs text-muted-foreground mt-0.5">
                                                    <span
                                                        class="px-1.5 py-0.5 rounded bg-gray-200">{{ $translation[$doc->category] }}</span>
                                                    {{-- <span>År {{ $doc['year'] }}</span> --}}
                                                    {{-- <span>{{ $doc->getFormattedSizeAttribute }} KB</span> --}}
                                                    <span>Uppladdad {{ $doc->created_at->format('Y-m-d H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-sm text-primary hover:underline">
                                            <a href="{{ route('admin.document.download', $doc) }}">Ladda ner</a>
                                        </button>

                                        <form action="{{ route('admin.document.destroy', $doc) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Är du säker på att du vill ta bort denna fil?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Ta bort
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                            <!-- Add upload / edit form here -->
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
@endsection
