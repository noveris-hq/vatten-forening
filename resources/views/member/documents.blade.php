@extends('member.layout')
@section('title', 'Dokument - Medlemsportal')

@section('content')
    <x-dashboard-nav />

    <main class="container mx-auto px-4 py-8">
        <div class="space-y-8">
            <!-- Header + quick admin link -->
            <div>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-foreground">Dokument</h1>
                        <p class="mt-1 text-muted-foreground">
                            Stadgar, protokoll, mötesanteckningar och andra viktiga dokument från föreningen.
                        </p>
                    </div>

                    @if (auth()->user()?->is_admin)
                        <button
                            class="inline-flex items-center gap-2 rounded-md border border-input bg-white px-4 py-2 text-sm font-medium text-foreground shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <a href="{{ route('admin.document.index') }}"
                                class="text-sm font-medium text-primary hover:underline">
                                Ladda upp dokument
                            </a>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Main documents section -->
            <div class="rounded-xl border border-gray-200 bg-white text-card-foreground">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h2 class="text-2xl font-semibold leading-none tracking-tight">
                        Alla dokument
                    </h2>
                    <p class="text-sm text-muted-foreground">
                        {{ $documents->count() }} dokument tillgängliga
                    </p>
                </div>

                <div class="p-6">
                    @if ($documents->isEmpty())
                        <div class="py-10 text-center text-muted-foreground">
                            Inga dokument uppladdade än.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($documents as $doc)
                                <div
                                    class="flex flex-col gap-3 rounded-lg border border-gray-200 bg-white p-4 transition-colors hover:bg-muted/60 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-start gap-3">
                                        <!-- File icon -->
                                        <div class="mt-0.5 rounded-md bg-muted p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="font-medium leading-tight">{{ $doc->filename }}</p>

                                            <div
                                                class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-muted-foreground">
                                                @if ($doc->uploader)
                                                    <span>Uppladdad av: {{ $doc->uploader->name }}</span>
                                                @endif

                                                @if (isset($translation[$doc->category]))
                                                    <span
                                                        class="inline-flex items-center rounded border border-input bg-background px-2 py-0.5 text-xs font-medium">
                                                        {{ $translation[$doc->category] }}
                                                    </span>
                                                @endif

                                                <span>Uppladdad {{ $doc->created_at->format('Y-m-d') }}</span>

                                                {{-- Uncomment if you want to show file size --}}
                                                {{-- <span>{{ $doc->getFormattedSizeAttribute ?? '—' }}</span> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('admin.document.download', $doc) }}"
                                            class="inline-flex items-center gap-1.5 rounded-md border border-input bg-background px-3 py-1.5 text-sm font-medium text-foreground shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Ladda ner
                                        </a>

                                        @if (auth()->user()?->is_admin)
                                            <form action="{{ route('admin.document.destroy', $doc) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Är du säker på att du vill ta bort {{ $doc->filename }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-sm text-red-600 hover:text-red-800 hover:underline">
                                                    Ta bort
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Back link -->
            {{-- <div class="pt-4"> --}}
            {{--     <a href="{{ route('member.dashboard') }}" --}}
            {{--        class="inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline"> --}}
            {{--         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"> --}}
            {{--             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /> --}}
            {{--         </svg> --}}
            {{--         Tillbaka till översikt --}}
            {{--     </a> --}}
            {{-- </div> --}}
        </div>
    </main>
@endsection

{{-- @extends('member.layout') --}}
{{-- --}}
{{-- @section('title', 'Min sida - Medlemsportal') --}}
{{-- --}}
{{-- @section('content') --}}
{{--     <main class="container mx-auto px-4 py-8"> --}}
{{--         <div class="space-y-6"> --}}
{{--             <!-- Header --> --}}
{{--             <div class="mb-8"> --}}
{{--                 <h1 class="text-3xl font-bold text-foreground">Dokument</h1> --}}
{{--                 <p class="text-muted-foreground mt-1"> --}}
{{--                     Protokoll, stadgar och andra viktiga dokument från föreningen. --}}
{{--                 </p> --}}
{{--             </div> --}}
{{-- --}}
{{--             <!-- Documents Grid --> --}}
{{--             <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3"> --}}
{{--                 @if (auth()->user()->is_admin) --}}
{{--                     <a href="{{ route('admin.document.index') }}" --}}
{{--                         class="rounded-lg border border-dashed border-gray-300 bg-card text-card-foreground shadow-sm flex items-center justify-center p-6 hover:bg-gray-50"> --}}
{{--                         <div class="text-center"> --}}
{{--                             <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary mb-2" viewBox="0 0 24 24" --}}
{{--                                 fill="none" stroke="currentColor" stroke-width="2"> --}}
{{--                                 <path d="M12 4v16m8-8H4" /> --}}
{{--                             </svg> --}}
{{--                             <span class="font-semibold text-lg text-primary">Ladda upp nytt dokument</span> --}}
{{--                         </div> --}}
{{--                     </a> --}}
{{--                 @endif --}}
{{--                 <!-- Example Document Cards --> --}}
{{--                 <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm"> --}}
{{--                     <div class="p-6"> --}}
{{--                         <div class="flex items-center gap-3 mb-3"> --}}
{{--                             <div class="p-2 rounded-lg bg-blue-50"> --}}
{{--                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" --}}
{{--                                     fill="none" stroke="currentColor" stroke-width="2"> --}}
{{--                                     <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" /> --}}
{{--                                     <path d="M14 2v6h6" /> --}}
{{--                                 </svg> --}}
{{--                             </div> --}}
{{--                             <div> --}}
{{--                                 <h3 class="font-semibold">Stadgar</h3> --}}
{{--                                 <p class="text-sm text-muted-foreground">Föreningens stadgar och regler</p> --}}
{{--                             </div> --}}
{{--                         </div> --}}
{{--                         <div class="flex items-center justify-between"> --}}
{{--                             <span class="text-xs text-muted-foreground">Senast uppdaterad: 2024-01-15</span> --}}
{{--                             <a href="#" class="text-primary hover:underline text-sm">Ladda ner</a> --}}
{{--                         </div> --}}
{{--                     </div> --}}
{{--                 </div> --}}
{{-- --}}
{{--                 <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm"> --}}
{{--                     <div class="p-6"> --}}
{{--                         <div class="flex items-center gap-3 mb-3"> --}}
{{--                             <div class="p-2 rounded-lg bg-green-50"> --}}
{{--                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 24 24" --}}
{{--                                     fill="none" stroke="currentColor" stroke-width="2"> --}}
{{--                                     <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" /> --}}
{{--                                     <path d="M14 2v6h6" /> --}}
{{--                                 </svg> --}}
{{--                             </div> --}}
{{--                             <div> --}}
{{--                                 <h3 class="font-semibold">Årsmötesprotokoll 2024</h3> --}}
{{--                                 <p class="text-sm text-muted-foreground">Protokoll från årets årsmöte</p> --}}
{{--                             </div> --}}
{{--                         </div> --}}
{{--                         <div class="flex items-center justify-between"> --}}
{{--                             <span class="text-xs text-muted-foreground">2024-03-20</span> --}}
{{--                             <a href="#" class="text-primary hover:underline text-sm">Ladda ner</a> --}}
{{--                         </div> --}}
{{--                     </div> --}}
{{--                 </div> --}}
{{-- --}}
{{--                 <div class="rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm"> --}}
{{--                     <div class="p-6"> --}}
{{--                         <div class="flex items-center gap-3 mb-3"> --}}
{{--                             <div class="p-2 rounded-lg bg-purple-50"> --}}
{{--                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 24 24" --}}
{{--                                     fill="none" stroke="currentColor" stroke-width="2"> --}}
{{--                                     <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" /> --}}
{{--                                     <path d="M14 2v6h6" /> --}}
{{--                                 </svg> --}}
{{--                             </div> --}}
{{--                             <div> --}}
{{--                                 <h3 class="font-semibold">Verksamhetsplan</h3> --}}
{{--                                 <p class="text-sm text-muted-foreground">Plan för föreningens verksamhet</p> --}}
{{--                             </div> --}}
{{--                         </div> --}}
{{--                         <div class="flex items-center justify-between"> --}}
{{--                             <span class="text-xs text-muted-foreground">Senast uppdaterad: 2024-01-10</span> --}}
{{--                             <a href="#" class="text-primary hover:underline text-sm">Ladda ner</a> --}}
{{--                         </div> --}}
{{--                     </div> --}}
{{--                 </div> --}}
{{--             </div> --}}
{{-- --}}
{{--             <!-- Back to Dashboard --> --}}
{{--             <div class="pt-6 border-t"> --}}
{{--                 <a href="{{ route('member.dashboard') }}" --}}
{{--                     class="inline-flex items-center gap-2 text-primary hover:underline"> --}}
{{--                     <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"> --}}
{{--                         <path d="M19 12H5M12 19l-7-7 7-7" /> --}}
{{--                     </svg> --}}
{{--                     Tillbaka till översikt --}}
{{--                 </a> --}}
{{--             </div> --}}
{{--         </div> --}}
{{--     </main> --}}
{{-- @endsection --}}
