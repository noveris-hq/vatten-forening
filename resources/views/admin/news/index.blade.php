@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-foreground">Nyheter</h1>
            <p class="mt-2 text-gray-500">Skapa, redigera och ta bort nyheter för föreningen.</p>
        </div>
        <div class="bg-card p-6 rounded-xl border bg-white border-gray-200">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-foreground">Nyheter &amp; meddelanden</h3>
                    <a href="{{ route('nyheter.create') }}"
                        class="bg-blue-950/80 text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus h-4 w-4">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Lägg till nyhet</a>
                </div>
                @foreach ($news as $item)
                    <div class="space-y-3">
                        <div class="p-4 bg-silver-50/10 rounded-lg border border-gray-200">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-medium text-foreground">{{ $item->title }}</h4>
                                        @if ($item->is_important)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-400/20 text-yellow-950">
                                                Viktig
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-muted-foreground mt-1">
                                        {{ Str::limit($item->content, 100) }}
                                    </p>
                                    <div class="flex items-center gap-1 mt-2 text-xs text-muted-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-calendar h-3 w-3">
                                            <path d="M8 2v4"></path>
                                            <path d="M16 2v4"></path>
                                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                            <path d="M3 10h18"></path>
                                        </svg>{{ $item->created_at->format('Y-m-d') }}
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <a href="{{ route('nyheter.edit', $item->id) }}">
                                        <button title="Redigera"
                                            class="hover:cursor-pointer hover:bg-teal-200/30 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-8 w-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-pen h-4 w-4">
                                                <path
                                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z">
                                                </path>
                                            </svg>
                                            <span class="sr-only">
                                                Redigera</span>
                                        </button>
                                    </a>
                                    <form action="{{ route('nyheter.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Är du säker att du vill radera denna nyhet?')"
                                            title="Ta bort"
                                            class="hover:cursor-pointer hover:bg-teal-200/30 hover:text-red-500 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent h-8 w-8 text-destructive hover:text-destructive">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash2 h-4 w-4">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                            </svg><span class="sr-only">Ta bort</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-8 p-4 bg-muted rounded-lg border border-gray-200">
            <p class="text-sm text-muted-foreground text-center">
                <strong class="text-foreground">OBS:</strong> Ändringar sparas endast i webbläsaren just nu. För permanent
                lagring krävs integration med en databas.
            </p>
        </div>
    </div>
    {{-- <main class="container mx-auto px-4 py-8"> --}}
    {{--     <h1 class="text-2xl font-bold mb-6">Hantera Nyheter</h1> --}}
    {{-- --}}
    {{--     @if (session('success')) --}}
    {{--         <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"> --}}
    {{--             {{ session('success') }} --}}
    {{--         </div> --}}
    {{--     @endif --}}
    {{-- --}}
    {{--     <div class="mb-4"> --}}
    {{--         <a href="{{ route('nyheter.create') }}" --}}
    {{--             class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> --}}
    {{--             Skapa ny nyhet --}}
    {{--         </a> --}}
    {{--     </div> --}}
    {{-- --}}
    {{--     <div class="overflow-x-auto"> --}}
    {{--         <table class="min-w-full bg-white border border-gray-300"> --}}
    {{--             <thead class="bg-gray-50"> --}}
    {{--                 <tr> --}}
    {{--                     <th --}}
    {{--                         class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-300"> --}}
    {{--                         Titel</th> --}}
    {{--                     <th --}}
    {{--                         class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-300"> --}}
    {{--                         Innehåll</th> --}}
    {{--                     <th --}}
    {{--                         class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-300"> --}}
    {{--                         Datum</th> --}}
    {{--                     <th --}}
    {{--                         class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-300"> --}}
    {{--                         Viktig</th> --}}
    {{--                     <th --}}
    {{--                         class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-300"> --}}
    {{--                         Åtgärder</th> --}}
    {{--                 </tr> --}}
    {{--             </thead> --}}
    {{--             <tbody class="bg-white divide-y divide-gray-200"> --}}
    {{--                 @foreach ($news as $item) --}}
    {{--                     <tr> --}}
    {{--                         <td --}}
    {{--                             class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b border-gray-300"> --}}
    {{--                             {{ $item->title }}</td> --}}
    {{--                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-300"> --}}
    {{--                             {{ Str::limit($item->content, 50) }}</td> --}}
    {{--                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-300"> --}}
    {{--                             {{ $item->created_at }}</td> --}}
    {{--                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b border-gray-300"> --}}
    {{--                             {{ $item->is_important ? 'Ja' : 'Nej' }}</td> --}}
    {{--                         <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-b border-gray-300"> --}}
    {{--                             <a href="{{ route('nyheter.edit', $item->id) }}" --}}
    {{--                                 class="text-indigo-600 hover:text-indigo-900 mr-4">Redigera</a> --}}
    {{--                             <form action="{{ route('nyheter.destroy', $item->id) }}" method="POST" class="inline"> --}}
    {{--                                 @csrf --}}
    {{--                                 @method('DELETE') --}}
    {{--                                 <button type="submit" --}}
    {{--                                     onclick="return confirm('Är du säker att du vill radera denna nyhet?')" --}}
    {{--                                     class="text-red-600 hover:text-red-900">Radera</button> --}}
    {{--                             </form> --}}
    {{--                         </td> --}}
    {{--                     </tr> --}}
    {{--                 @endforeach --}}
    {{--             </tbody> --}}
    {{--         </table> --}}
    {{--     </div> --}}
    {{-- --}}
    {{--     {{ $news->links() }} --}}
    {{-- </main> --}}
@endsection
