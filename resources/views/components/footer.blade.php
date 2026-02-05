<footer class="bg-gray-50 dark:bg-gray-800/50 border-t border-gray-300 dark:border-gray-700">
    <div class="container py-12 mx-auto px-4">
        <div class="grid gap-8 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="pr-2 rounded-lg">
                        <img src="/assets/droplet.svg" class="h-6 w-6 dark:invert" alt="droplet" />
                    </div>

                    <span class="font-serif font-semibold text-gray-900 dark:text-gray-100">
                        Östra Karbäckens Vattenförening
                    </span>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 max-w-xs">
                    {{ Statamic::modify($page->contact_intro)->stripTags() }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Snabblänkar
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#om-oss"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors focus-ring rounded">
                            Om föreningen
                        </a>
                    </li>
                    <li>
                        <a href="#status"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors focus-ring rounded">
                            Driftstatus
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Kontakt
                </h3>
                <ul class="space-y-3 text-sm">
                    <li class="text-gray-600 dark:text-gray-400">
                        <a href="tel:{{ $page->contact_phone }}"
                            class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors focus-ring rounded">
                            {{ $page->contact_phone }}
                        </a>
                    </li>
                    <li class="text-gray-600 dark:text-gray-400">
                        <a href="mailto:{{ $page->contact_email }}"
                            class="hover:text-gray-900 dark:hover:text-gray-100 transition-colors focus-ring rounded">
                            {{ $page->contact_email }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="mt-10 pt-6 border-t border-gray-300 dark:border-gray-700 text-center text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ '© ' . date('Y') }} Östra Karbäckens Vattenförening. Alla
                rättigheter förbehållna.
            </p>
        </div>
    </div>
</footer>
