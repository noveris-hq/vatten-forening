@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto py-8">
        <div class=" mx-auto">
            <div class="space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-foreground mb-2">Medlemmar</h1>
                        <p class="text-muted-foreground">Hantera medlemmar och se betalningsstatus</p>
                    </div>
                    <button
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus h-4 w-4">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Lägg till medlem
                    </button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="rounded-lg border border-gray-200 bg-white text-card-foreground">
                        <div class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-primary/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-users h-5 w-5 text-primary">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-foreground">{{ $totalMembers }}</p>
                                    <p class="text-sm text-muted-foreground">Totalt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-white text-card-foreground">
                        <div class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-success/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-check-big h-5 w-5 text-success">
                                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                        <path d="m9 11 3 3L22 4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-foreground">{{ $paidMembers }}</p>
                                    <p class="text-sm text-muted-foreground">Betalda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-white text-card-foreground">
                        <div class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-x h-5 w-5 text-muted-foreground">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="m15 9-6 6"></path>
                                        <path d="m9 9 6 6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-foreground">{{ $unpaidMembers }}</p>
                                    <p class="text-sm text-muted-foreground">Ej betalda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-white text-card-foreground">
                        <div class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-destructive/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-alert h-5 w-5 text-destructive">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" x2="12" y1="8" y2="12"></line>
                                        <line x1="12" x2="12.01" y1="16" y2="16"></line>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-foreground">{{ $overdueMembers }}</p>
                                    <p class="text-sm text-muted-foreground">Förfallna</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white text-card-foreground">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-2xl font-semibold leading-none tracking-tight">Alla medlemmar</h3>
                        <p class="text-sm text-muted-foreground">Översikt över alla medlemmar och deras betalningsstatus för
                            årsavgiften</p>
                    </div>
                    <div class="p-6 pt-0 space-y-4">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-search absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                                <input
                                    class="flex h-10 w-full rounded-md border border-gray-200 bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm pl-10"
                                    placeholder="Sök på namn, e-post, telefon eller adress..." value="">
                            </div>
                            <button type="button" role="combobox" aria-controls="radix-:r18:" aria-expanded="false"
                                aria-autocomplete="none" dir="ltr" data-state="closed"
                                class="flex h-10 items-center justify-between rounded-md border border-gray-200 bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1 w-full sm:w-[180px]">
                                <span style="pointer-events: none;">Alla statusar</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down h-4 w-4 opacity-50" aria-hidden="true">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="relative w-full overflow-auto">
                            <table class="w-full caption-bottom text-sm">
                                <thead class="[&_tr]:border-b [&_tr]:border-gray-200">
                                    <tr
                                        class="border-b transition-colors data-[state=selected]:bg-muted hover:bg-muted/50">
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                            Namn</th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 hidden md:table-cell">
                                            E-post</th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 hidden lg:table-cell">
                                            Telefon</th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 hidden xl:table-cell">
                                            Adress</th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                                            Status</th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 hidden sm:table-cell">
                                            Senaste betalning</th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 w-[120px]">
                                            Åtgärder</th>
                                    </tr>
                                </thead>
                                <tbody class="[&_tr:last-child]:border-0">
                                    @foreach ($users as $user)
                                        <tr
                                            class="border-b transition-colors data-[state=selected]:bg-muted hover:bg-muted/50">
                                            <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0 font-medium">
                                                {{ $user->name }}</td>
                                            <td
                                                class="p-4 align-middle [&:has([role=checkbox])]:pr-0 hidden md:table-cell">
                                                {{ $user->email }}</td>
                                            <td
                                                class="p-4 align-middle [&:has([role=checkbox])]:pr-0 hidden lg:table-cell">
                                                {{ $user->phone }}</td>
                                            <td
                                                class="p-4 align-middle [&:has([role=checkbox])]:pr-0 hidden xl:table-cell">
                                                {{ $user->street_name }} {{ $user->property_number }},
                                                {{ $user->postal_code }} {{ $user->city }}</td>
                                            <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                                @if ($user->membership_status === 'paid')
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 hover:bg-primary/80 bg-success/10 text-success border-success/20 gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-circle-check-big h-3 w-3">
                                                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                                            <path d="m9 11 3 3L22 4"></path>
                                                        </svg>
                                                        Betald
                                                    </div>
                                                @elseif($user->membership_status === 'unpaid')
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-circle-x h-3 w-3">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <path d="m15 9-6 6"></path>
                                                            <path d="m9 9 6 6"></path>
                                                        </svg>
                                                        Ej betald
                                                    </div>
                                                @elseif($user->membership_status === 'overdue')
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-destructive text-destructive-foreground hover:bg-destructive/80 gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-circle-alert h-3 w-3">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="12" x2="12" y1="8"
                                                                y2="12"></line>
                                                            <line x1="12" x2="12.01" y1="16"
                                                                y2="16"></line>
                                                        </svg>
                                                        Förfallen
                                                    </div>
                                                @else
                                                    <div
                                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-muted text-muted-foreground hover:bg-muted/80 gap-1">
                                                        {{ ucfirst($user->membership_status) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td
                                                class="p-4 align-middle [&:has([role=checkbox])]:pr-0 hidden sm:table-cell text-muted-foreground">
                                                {{ $user->updated_at->format('Y-m-d') }}</td>
                                            <td class="p-4 align-middle [&:has([role=checkbox])]:pr-0">
                                                <div class="flex items-center gap-1">
                                                    <button
                                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-10 w-10"
                                                        title="Redigera">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-pencil h-4 w-4">
                                                            <path
                                                                d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z">
                                                            </path>
                                                            <path d="m15 5 4 4"></path>
                                                        </svg>
                                                    </button>
                                                    <button
                                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 hover:bg-accent h-10 w-10 text-destructive hover:text-destructive"
                                                        title="Ta bort">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-trash2 h-4 w-4">
                                                            <path d="M3 6h18"></path>
                                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                            <line x1="10" x2="10" y1="11"
                                                                y2="17"></line>
                                                            <line x1="14" x2="14" y1="11"
                                                                y2="17"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($users->hasPages())
                                <div class="mt-4">
                                    {{ $users->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
