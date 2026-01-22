<header class="border-b border-gray-200 bg-white sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
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
            <div class="flex items-center gap-2"><span class="text-sm text-gray-700">Inloggad som:</span><span
                    class="text-sm font-medium text-green-600">{{ auth()->user()->email }}</span>
                @if (auth()->user()->is_admin)
                    - <span class="text-sm font-semibold text-gray-600">Admin</span>
                @endif
            </div>
            <form method="POST" action="/logout" class="inline-flex items-center ml-3">

                @csrf
                <button type="submit"
                    class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-gray-300 bg-transparent hover:bg-teal-50 hover:text-teal-600 hover:cursor-pointer h-9 rounded-md px-3 gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-log-out h-4 w-4">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" x2="9" y1="12" y2="12"></line>
                    </svg><span class="hidden sm:inline">Logga ut</span></button>
            </form>
        </div>
    </div>
</header>
<nav class="border-b border-gray-200 mb-8 bg-gray-50 sticky top-16 z-40">
    <div class="container mx-auto px-4">
        <div class="flex gap-1">
            <a href="{{ route('member.dashboard') }}">
                <button
                    class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-teal-50 hover:text-teal-600 h-10 px-4 py-2 gap-2 rounded-none {{ request()->routeIs('member.dashboard') ? 'bg-gray-200/50 border-b-2' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-bell h-4 w-4">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                    </svg>
                    <span class="hidden sm:inline">Översikt</span>
                </button>
            </a>
            <a href="{{ route('member.documents') }}">
                <button
                    class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-teal-50 hover:text-teal-600 h-10 px-4 py-2 gap-2 rounded-none {{ request()->routeIs('member.documents') ? 'bg-gray-200/50 border-b-2' : '' }}">
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
                <div class="flex justify-center">
                    <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }

                            this.$refs.button.focus()

                            this.open = true
                        },
                        close(focusAfter) {
                            if (!this.open) return

                            this.open = false

                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                        x-id="['dropdown-button']" class="relative">
                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="inline-flex hover:cursor-pointer items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 h-10 px-4 py-2 gap-2 rounded-none {{ request()->routeIs('admin.dashboard') || request()->is('adminportal/*') ? 'bg-gray-200/50 border-b-2' : '' }}"
                            <span>Admin</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="size-4">
                                <path fill-rule="evenodd"
                                    d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-ref="panel" x-show="open" x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" x-cloak
                            class="absolute left-0 min-w-48 rounded-lg shadow-sm mt-2 z-10 origin-top-left bg-white p-1.5 outline-none border border-gray-200">
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600">Driftstatus</a>
                            <a href="{{ route('nyheter.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600">Nyheter</a>
                            <a href="{{ route('admin.document.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600">Dokument</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>
