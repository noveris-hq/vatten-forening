<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    <!-- Documents -->
    <a href="{{ route('member.documents') }}"
        class="group block rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-200">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <path d="M14 2v6h6" />
                        <path d="M16 13H8" />
                        <path d="M16 17H8" />
                        <path d="M10 9H8" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Dokument</h3>
            </div>
            <p class="text-sm text-muted-foreground">
                Protokoll, stadgar och andra viktiga dokument
            </p>
        </div>
    </a>

    <!-- Payments -->
    <a href="{{ route('member.payments') }}"
        class="group block rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-200">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2 rounded-lg bg-green-50 group-hover:bg-green-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Betalningar</h3>
            </div>
            <p class="text-sm text-muted-foreground">
                Hantera din medlemsavgift och betalningar
            </p>
        </div>
    </a>

    <!-- Admin (if applicable) -->
    @if (auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}"
            class="group block rounded-lg border border-gray-300 bg-card text-card-foreground shadow-sm hover:shadow-md transition-all duration-200">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="p-2 rounded-lg bg-purple-50 group-hover:bg-purple-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Admin</h3>
                </div>
                <p class="text-sm text-muted-foreground">
                    Administrationspanel för föreningen
                </p>
            </div>
        </a>
    @endif
</div>
