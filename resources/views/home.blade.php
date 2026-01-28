@extends('layout')

@section('content')
    <main class="flex-1">
        <section class="relative overflow-hidden" aria-labelledby="hero-heading">
            <div class="absolute inset-0">
                @if ($page->hero_image)
                    <img src="{{ $page->hero_image->url }}" alt="{{ $page->hero_image_alt ?? 'Vattenkälla i svensk natur' }}"
                        class="w-full h-full object-cover" />
                @endif
                <div class="absolute inset-0 hero-overlay"></div>
            </div>

            <div class="relative container mx-auto px-4 py-24 md:py-32 lg:py-40">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-white/90 font-medium text-sm tracking-wide uppercase">
                            {{ $page->hero_badge }}
                        </span>
                    </div>

                    <h1 id="hero-heading"
                        class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white leading-tight">
                        {{ $page->hero_title }}
                    </h1>

                    <div class="mt-6 text-lg md:text-xl text-white/85 max-w-xl prose prose-invert">
                        {!! $page->hero_content !!}
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        @if (!auth()->check())
                            <a href="/login"
                                class="inline-flex items-center justify-center px-6 py-3 bg-white text-blue-900 hover:bg-gray-100 rounded-lg font-medium transition-colors">
                                Logga in som medlem
                            </a>
                        @endif
                        <a href="#om-oss"
                            class="inline-flex items-center justify-center px-6 py-3 border-2 border-white/30 text-white bg-transparent hover:bg-white/10 rounded-lg font-medium transition-colors">
                            Läs mer om oss
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="status" class="py-8 bg-gray-50 dark:bg-gray-800/50 scroll-mt-16">
            <div class="container mx-auto px-4 max-w-2xl">
                @if ($page->system_status)
                    <x-status-banner :status="$status" />
                @endif
            </div>
        </section>

        <section class="py-16 md:py-24">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 dark:text-gray-100">
                        {{ $page->cards_title }}
                    </h2>

                    <div class="mt-4 text-gray-600 dark:text-gray-300 text-lg prose dark:prose-invert">
                        {!! $page->cards_description !!}
                    </div>
                </div>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($page->cards as $card)
                        <x-info-card :icon="$card['icon']" :card_title="$card['title']" :card_content="$card['card_content']" :card_link_text="$card['card_link_text']"
                            :url="$card['url']" />
                    @endforeach
                </div>
            </div>
        </section>

        <section id="om-oss" class="py-16 md:py-24 bg-gray-50 dark:bg-gray-800/50 scroll-mt-16">
            <div class="container mx-auto px-4">
                <div class="grid gap-12 lg:grid-cols-2 items-center">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 dark:text-gray-100">
                            {{ $page->about_title }}
                        </h2>

                        <div class="mt-6 space-y-4 text-gray-600 dark:text-gray-300 prose dark:prose-invert">
                            {!! $page->about_content !!}
                        </div>

                        {{-- @if ($page->property_count) --}}
                        {{--     <div class="mt-8 p-4 bg-white rounded-lg border border-gray-200 shadow-sm"> --}}
                        {{--         <p class="font-medium text-gray-900"> --}}
                        {{--             Västra Karbäcken --}}
                        {{--         </p> --}}
                        {{--         <p class="text-sm text-gray-600"> --}}
                        {{--             ~{{ $page->property_count }} anslutna fastigheter --}}
                        {{--         </p> --}}
                        {{--     </div> --}}
                        {{-- @endif --}}
                    </div>

                    <div class="relative">
                        @if ($page->about_image)
                            <div class="aspect-[4/3] rounded-xl overflow-hidden shadow-xl">
                                <img src="{{ $page->about_image->url }}"
                                    alt="{{ $page->about_image_alt ?? 'Naturskönt område' }}"
                                    class="w-full h-full object-cover" />
                            </div>
                        @endif
                        @if ($page->property_count)
                            <div
                                class="absolute -bottom-4 -left-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700">
                                <p class="text-2xl font-serif font-bold text-blue-900/90 dark:text-blue-400">
                                    {{ $page->property_count }}st
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">fastigheter</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- <section id="kontakt" class="py-16 md:py-24"> --}}
        {{--     <div class="container mx-auto px-4"> --}}
        {{--         <div class="grid gap-12 lg:grid-cols-2"> --}}
        {{--             <div> --}}
        {{--                 <h2 --}}
        {{--                     class="text-3xl md:text-4xl font-serif font-bold text-gray-900" --}}
        {{--                 > --}}
        {{--                     Kontakta oss --}}
        {{--                 </h2> --}}
        {{-- --}}
        {{--                 <div class="mt-4 text-gray-600 text-lg prose"> --}}
        {{--                     {{ contact_intro }} --}}
        {{--                 </div> --}}
        {{-- --}}
        {{--                 <div class="mt-8 space-y-4"> --}}
        {{--                     {{ if contact_phone }} --}}
        {{--                     <div class="p-4 bg-gray-50 rounded-lg"> --}}
        {{--                         <p class="text-sm text-gray-600">Telefon</p> --}}
        {{--                         <a --}}
        {{--                             href="tel:{{ contact_phone }}" --}}
        {{--                             class="font-medium text-gray-900 hover:text-blue-600 transition-colors" --}}
        {{--                         > --}}
        {{--                             {{ contact_phone }} --}}
        {{--                         </a> --}}
        {{--                     </div> --}}
        {{--                     {{ /if }} {{ if contact_email }} --}}
        {{--                     <div class="p-4 bg-gray-50 rounded-lg"> --}}
        {{--                         <p class="text-sm text-gray-600">E-post</p> --}}
        {{--                         <a --}}
        {{--                             href="mailto:{{ contact_email }}" --}}
        {{--                             class="font-medium text-gray-900 hover:text-blue-600 transition-colors" --}}
        {{--                         > --}}
        {{--                             {{ contact_email }} --}}
        {{--                         </a> --}}
        {{--                     </div> --}}
        {{--                     {{ /if }} --}}
        {{--                 </div> --}}
        {{--             </div> --}}
        {{-- --}}
        {{--             <div --}}
        {{--                 class="bg-white p-8 rounded-xl shadow-xl border border-gray-200" --}}
        {{--             > --}}
        {{--                 <h3 --}}
        {{--                     class="text-xl font-serif font-semibold text-gray-900 mb-6" --}}
        {{--                 > --}}
        {{--                     Skicka ett meddelande --}}
        {{--                 </h3> --}}
        {{-- --}}
        {{--                 {{ partial:contact-form }} --}}
        {{--             </div> --}}
        {{--         </div> --}}
        {{--     </div> --}}
        {{-- </section> --}}
    </main>
@endsection
