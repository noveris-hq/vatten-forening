<header class="border-b border-gray-300 bg-white sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                {{-- <a href="/"><button --}}
                {{--         class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3 gap-2"><svg --}}
                {{--             xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" --}}
                {{--             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" --}}
                {{--             stroke-linejoin="round" class="lucide lucide-arrow-left h-4 w-4"> --}}
                {{--             <path d="m12 19-7-7 7-7"></path> --}}
                {{--             <path d="M19 12H5"></path> --}}
                {{--         </svg>Tillbaka</button></a> --}}
                <div class="flex items-center gap-2">
                    @if (!auth()->user()->is_admin)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user h-5 w-5 text-primary">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="font-medium">Medlemssida</span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2"><span class="text-sm text-muted-foreground">Inloggad som:</span><span
                    class="text-sm font-medium text-green-600">{{ auth()->user()->email }}</span>
                @if (auth()->user()->is_admin)
                    - <span class="text-sm font-semibold text-green-600">Admin</span>
                @endif
            </div>
        </div>
    </div>
</header>
<nav class="border-b border-gray-300 mb-8 bg-gray-50 sticky top-16 z-40">
    <div class="container mx-auto px-4">
        <div class="flex gap-1">
            <a href="{{ route('member.dashboard') }}">
                <button
                    class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-teal-50 hover:text-teatl-600 h-10 px-4 py-2 gap-2 rounded-none {{ request()->routeIs('member.dashboard') ? 'bg-gray-200/50 border-b-2' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-bell h-4 w-4">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                    </svg>
                    <span class="hidden sm:inline">Översikt</span>
                </button>
            </a>
            <a href="#">
                <button
                    class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-teal-50 hover:text-teal-600 h-10 px-4 py-2 gap-2 rounded-none{{ request()->routeIs('member.documents') ? 'bg-gray-200/50 border-b-2' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-file-text h-4 w-4">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                        <path d="M10 9H8"></path>
                        <path d="M16 13H8"></path>
                        <path d="M16 17H8"></path>
                    </svg>
                    <span class="hidden sm:inline">Dokument</span>
                </button>
            </a>
            <a href="{{ route('member.payments') }}"><button
                    class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-teal-50 hover:text-teal-600 h-10 px-4 py-2 gap-2 rounded-none {{ request()->routeIs('member.payments') ? 'bg-gray-200/50 border-b-2' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-credit-card h-4 w-4">
                        <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                        <line x1="2" x2="22" y1="10" y2="10"></line>
                    </svg>
                    <span class="hidden sm:inline">Betalning</span>
                </button>
            </a>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}">
                    <button
                        class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-teal-50 hover:text-teal-600 h-10 px-4 py-2 gap-2 rounded-none {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200/50 border-b-2' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shield-check h-4 w-4">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span class="hidden sm:inline">Admin</span>
                    </button>
                </a>
            @endif
        </div>
    </div>
</nav>
