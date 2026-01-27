@props(['waterValves', 'context' => ''])
<div class="rounded-lg border bg-white mt-10 border-gray-200">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-map-pin h-5 w-5 text-primary">
                <path
                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                </path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>Fastigheter och avstängare</h3>
        @if (auth()->user()->is_admin && $context === 'admin')
            <p class="text-sm text-muted-foreground">Klicka på en rad för att markera fastigheten på kartan</p>
        @endif
    </div>
    <div class="p-6 pt-0 space-y-4">
        @if (auth()->user()->is_admin && $context === 'admin')
            <div class="relative" x-data="{ search: '{{ request('search') }}' }">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-search absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                <form method="GET" action="{{ route('admin.map.index') }}">
                    <input x-Model="search"
                        class="flex h-10 w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm pl-10"
                        placeholder="Sök på namn, fastighet, adress..." name="search" value="{{ request('search') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" x-show="search"
                        @click.prevent="window.location = window.location.pathname"
                        class="lucide lucide-x absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground cursor-pointer"
                        id="clear-search">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </form>
            </div>
        @endif
        <div class="relative w-full overflow-auto overflow-x-auto">
            <table class="w-full caption-bottom text-sm">
                <thead class="[&amp;_tr]:border-b">
                    <tr class="border-b border-gray-200">
                        <th class="h-12 px-4 text-left align-middle font-medium text-gray-600 ">
                            Medlem</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-gray-600">
                            Fastighet</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-gray-600">
                            Adress</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-gray-600">
                            Ventil</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-gray-600">
                            Avstängarens position</th>
                        <th class="h-12 px-4 text-left align-middle font-medium text-gray-600">
                            Karta</th>
                    </tr>
                </thead>
                <tbody class="[&amp;_tr:last-child]:border-0">
                    @if ($waterValves->isEmpty())
                        <tr>
                            <td colspan="5" class="p-4 text-center text-muted-foreground">
                                Inga avstängare hittades.
                            </td>
                        </tr>
                    @endif
                    @foreach ($waterValves as $valve)
                        <tr class="border-b border-gray-200 transition-colors hover:bg-gray-100/50 cursor-pointer">
                            <td class="p-4 align-middle font-medium">
                                {{ $valve->user?->name ?? 'Huvudledning' }}</td>
                            <td class="p-4 align-middle">
                                <div
                                    class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground">
                                    {{ $valve->user?->property_number ?? 'Huvudledning' }}</div>
                            </td>
                            <td class="p-4 align-middle hidden sm:table-cell">
                                {{ $valve->user?->street_name ?? 'Huvudledning' }}</td>
                            <td class="p-4 align-middle hidden md:table-cell text-muted-foreground">
                                @if ($valve->is_open)
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800">Öppen</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800">Stängd</span>
                                @endif
                            </td>
                            <td class="p-4 align-middle hidden md:table-cell text-gray-600">
                                {{ $valve->location_description }}</td>
                            <td class="p-4 align-middle">
                                <div
                                    class="inline-flex items-center rounded-full border bg-blue-900/70 text-white px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-primary text-primary-foreground hover:bg-primary/80 gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-map-pin h-3 w-3">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                        </path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>Visa
                                </div>
                                @if (auth()->user()->is_admin && $context === 'admin')
                                    <a href="{{ route('medlemmar.edit', auth()->user()->id) }}" class="ml-2 z-10">
                                        <button
                                            class="inline-flex rounded items-center hover:bg-teal-100 justify-center gap-2 hover:cursor-pointer whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground rounded-md h-6 w-6 p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-square-pen h-3 w-3">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z">
                                                </path>
                                            </svg>
                                        </button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
