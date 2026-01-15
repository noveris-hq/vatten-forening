<header x-data="{ isMenuOpen: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="/"
                class="flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md"
                aria-label="Västra Karbäckens vattenförening - Hem">
                <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-lightblue-600">
                    <img src="/assets/droplet.svg" class="h-4 w-4" alt="droplet" />
                </div>
                <span class="font-semibold text-gray-900 hidden sm:block">
                    Västra Karbäckens vattenförening
                </span>
            </a>

            {{-- !TODO: add a auth check for removing om oss, status, kontakt when user is logged in
                {{-- it should only show logout, min sida and Inloggad som:
                {{-- medlem@exempel.se  --}}

            <nav class="hidden md:flex items-center gap-1" aria-label="Huvudnavigering">
                <a href="#om-oss"
                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md">
                    Om oss
                </a>

                <a href="#status"
                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md">
                    Driftstatus
                </a>

                <a href="#kontakt"
                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md">
                    Kontakt
                </a>
                @if (auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-900/90 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Adminpanel
                    </a>
                    <form method="POST" action="/logout" class="inline-flex items-center ml-3">

                        @csrf
                        <button type="submit" class="items-center" title="Logga ut">
                            {{--     Logga ut --}}
                            <x-ionicon-log-out-outline
                                class="w-8
                            h-8 text-gray-500 hover:cursor-pointer" />
                        </button>
                    </form>
                @elseif (auth()->check())
                    <a href="{{ route('member.dashboard') }}"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-900/90 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Medlemsportal
                    </a>
                    <form method="POST" action="/logout" class="inline-flex items-center ml-3">
                        @csrf
                        <button type="submit" title="Logga ut">
                            {{--     Logga ut --}}
                            <x-ionicon-log-out-outline class="w-8 h-8 text-gray-500 hover:cursor-pointer" />
                        </button>
                    </form>
                @else
                    <a href="/login"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-900/90 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Logga in
                    </a>
                @endif
            </nav>

            {{-- Mobile Menu Button --}}
            <button @click="isMenuOpen = !isMenuOpen"
                class="md:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                :aria-expanded="isMenuOpen" aria-controls="mobile-menu"
                :aria-label="isMenuOpen ? 'Stäng meny' : 'Öppna meny'">
                <svg x-show="!isMenuOpen" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="isMenuOpen" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav x-show="isMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" id="mobile-menu"
            class="md:hidden py-4 border-t border-gray-200" aria-label="Mobilnavigering">
            <div class="flex flex-col gap-1">
                <a href="#om-oss" @click="isMenuOpen = false"
                    class="px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Om oss
                </a>
                <a href="#status" @click="isMenuOpen = false"
                    class="px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Driftstatus
                </a>
                <a href="#kontakt" @click="isMenuOpen = false"
                    class="px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Kontakt
                </a>
                @if (auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-900/90 text-white text-sm font-medium rounded-md  transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Adminpanel
                    </a>
                    <form method="POST" action="/logout" class=" ml-3 mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:cursor-pointer text-white text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Logga ut
                        </button>
                    </form>
                @elseif (auth()->check())
                    <a href="{{ route('member.dashboard') }}"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-900/90 text-white text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Medlemsportal
                    </a>
                    <form method="POST" action="/logout" class=" ml-3 mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center hover:cursor-pointer px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Logga ut
                        </button>
                    </form>
                @else
                    <a href="/login"
                        class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-900/90 text-white text-sm font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Logga in
                    </a>
                @endif
                {{-- --}}
                {{-- @if (auth()->check()) --}}
                {{--     <a href="/medlemsportal" --}}
                {{--         class="mt-3 mx-4 inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"> --}}
                {{--         Min sida --}}
                {{--     </a> --}}
                {{--     <form method="POST" action="/logout" class="mt-3 mx-4 inline-block"> --}}
                {{--         @csrf --}}
                {{--         <button type="submit" --}}
                {{--             class="inline-flex items-center justify-center px-4 py-3 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500"> --}}
                {{--             Logga ut --}}
                {{--         </button> --}}
                {{--     </form> --}}
                {{-- @else --}}
                {{--     <a href="/login" --}}
                {{--         class="mt-3 mx-4 inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"> --}}
                {{--         Logga in --}}
                {{--     </a> --}}
                {{-- @endif --}}
            </div>
        </nav>
    </div>
</header>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
