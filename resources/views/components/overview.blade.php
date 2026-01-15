 <!-- Viktiga meddelanden -->
 @if ($importantNews)
     <div class="rounded-lg border border-blue-200 bg-blue-50">
         <div class="flex flex-col space-y-1.5 p-6 pb-3">
             <h3 class="font-semibold tracking-tight text-lg flex items-center gap-2"><svg
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-bell h-5 w-5 text-primary">
                     <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                     <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                 </svg>Viktiga meddelanden</h3>
         </div>
         <div class="p-6 pt-0 space-y-3">
             <div class="p-4 bg-background rounded-lg border border-gray-200 bg-white">
                 <div class="flex items-start justify-between gap-4">
                     <div>
                         <h4 class="font-semibold">{{ $importantNews->title }}</h4>
                         <p class="text-sm text-gray-500 mt-1">{{ $importantNews->content }}</p>
                     </div>
                     <div
                         class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground shrink-0">
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
     <div class="rounded-lg border border-gray-200 bg-card text-card-foreground shadow-sm">
         <div class="p-6">
             <h3 class="text-lg font-semibold">Inga nyheter</h3>
             <p class="text-sm text-gray-500">Det finns inga viktiga meddelanden för tillfället.</p>
         </div>
     </div>
 @endif

 <div class="grid gap-6 md:grid-cols-2">
     <!-- Senaste nyheterna -->
     <div class="rounded-lg border border-gray-200 shadow-sm">
         <div class="p-6 pb-3">
             <h3 class="text-lg font-semibold">Senaste nytt</h3>
             <p class="text-sm text-gray-500">Nyheter och information från styrelsen</p>
         </div>
         <div class="px-6
                 pb-6 space-y-4">
             @if ($latestNews->isEmpty())
                 <p class="text-sm text-black">Det finns inga nyheter för tillfället.</p>
             @endif
             @foreach ($latestNews as $news)
                 <div class="flex items-start mt-3 gap-3 pb-3 border-b border-gray-200 last:border-0 last:pb-0">
                     {{-- <div class="h-2 w-2 rounded-full bg-primary mt-2 shrink-0"></div> --}}
                     <div class='h-2 w-2 mt-2 shrink-0 bg-blue-900/70 rounded-full'></div>
                     <div class="flex-1 min-w-0">
                         <div class="flex items-center gap-2">
                             <h4 class="font-medium text-sm">{{ $news->title }}</h4>
                             @if ($news->is_important)
                                 <span
                                     class="inline-flex items-center rounded-lg bg-blue-900/10 text-blue-900 font-bold px-1.5 py-0.5 text-xs">Viktigt</span>
                             @endif
                         </div>
                         <p class="text-xs text-gray-500 mt-0.5">
                             {{ $news->date->format('Y-m-d') }}
                         </p>
                         {{-- TODO: Show full content or link to full news article --}}
                         {{-- <p class="text-sm text-gray-700 mt-2"> --}}
                         {{--     {{ Str::limit($news->content, 15, '...') }} --}}
                         {{-- </p> --}}
                     </div>
                 </div>
             @endforeach
         </div>
     </div>

     <!-- Betalningsstatus -->
     <div class="rounded-lg border border-gray-200 bg-card text-card-foreground shadow-sm">
         <div class="p-6 pb-3">
             <h3 class="text-lg font-semibold">Medlemsavgift 2026</h3>
             <p class="text-sm text-muted-foreground">Status för din årsavgift</p>
         </div>
         <div class="px-6 pb-6 space-y-4">
             <div class="flex items-center justify-between">
                 <span class="text-muted-foreground">Status</span>
                 <span
                     class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Betald</span>
             </div>
             <div class="flex items-center justify-between">
                 <span class="text-muted-foreground">Förfallodatum</span>
                 <span class="font-medium">2026-01-31</span>
             </div>
             <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                 <span class="text-muted-foreground">Belopp</span>
                 <span class="font-medium">1 200 SEK</span>
             </div>
             <a href="{{ route('member.payments') }}"
                 class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-blue-800/70 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600/60 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="lucide lucide-credit-card h-4 w-4">
                     <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                     <line x1="2" x2="22" y1="10" y2="10"></line>
                 </svg>

                 Gå till betalning
             </a>
         </div>
     </div>
