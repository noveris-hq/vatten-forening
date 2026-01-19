@extends('member.layout')

@section('title', 'Min sida - Medlemsportal')

@section('content')
    <main class="container mx-auto px-4 py-8">
        <div class="space-y-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-foreground">Dokument</h1>
                <p class="text-muted-foreground mt-1">
                    Protokoll, stadgar och andra viktiga dokument från föreningen.
                </p>
            </div>

            <!-- Documents Grid -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.document.index') }}"
                        class="rounded-lg border border-dashed border-gray-300 bg-card text-card-foreground shadow-sm flex items-center justify-center p-6 hover:bg-gray-50">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary mb-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="font-semibold text-lg text-primary">Ladda upp nytt dokument</span>
                        </div>
                    </a>
                @endif
                <!-- Example Document Cards -->
                <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 rounded-lg bg-blue-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold">Stadgar</h3>
                                <p class="text-sm text-muted-foreground">Föreningens stadgar och regler</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-muted-foreground">Senast uppdaterad: 2024-01-15</span>
                            <a href="#" class="text-primary hover:underline text-sm">Ladda ner</a>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 rounded-lg bg-green-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold">Årsmötesprotokoll 2024</h3>
                                <p class="text-sm text-muted-foreground">Protokoll från årets årsmöte</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-muted-foreground">2024-03-20</span>
                            <a href="#" class="text-primary hover:underline text-sm">Ladda ner</a>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 rounded-lg bg-purple-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <path d="M14 2v6h6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold">Verksamhetsplan</h3>
                                <p class="text-sm text-muted-foreground">Plan för föreningens verksamhet</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-muted-foreground">Senast uppdaterad: 2024-01-10</span>
                            <a href="#" class="text-primary hover:underline text-sm">Ladda ner</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard -->
            <div class="pt-6 border-t">
                <a href="{{ route('member.dashboard') }}"
                    class="inline-flex items-center gap-2 text-primary hover:underline">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Tillbaka till översikt
                </a>
            </div>
        </div>
    </main>
@endsection
