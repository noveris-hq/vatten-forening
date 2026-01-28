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
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dokument</h1>
                        <p class="mt-1 text-gray-600 dark:text-gray-300">
                            Stadgar, protokoll, mötesanteckningar och andra viktiga dokument från föreningen.
                        </p>
                    </div>

                    @if (auth()->user()?->is_admin)
                        <button
                            class="inline-flex items-center gap-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 shadow-sm transition-colors hover:bg-gray-100 dark:hover:bg-gray-700">
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
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h2 class="font-semibold leading-none tracking-tight text-gray-900 dark:text-gray-100">
                        Dokument & Protokoll
                    </h2>
                    {{-- <p class="text-sm text-gray-600 dark:text-gray-400"> --}}
                    {{--     {{ $documents->count() }} dokument tillgängliga --}}
                    {{-- </p> --}}
                </div>

                <div class="px-6 pt-0 pb-6">
                    @if ($groupedDocuments->isEmpty())
                        <div class="py-10 text-center text-gray-600 dark:text-gray-400">
                            Inga dokument uppladdade än.
                        </div>
                    @else
                        <x-documents-table :groupedDocuments="$groupedDocuments" />
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
