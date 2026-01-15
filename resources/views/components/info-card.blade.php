@props(['icon' => '', 'card_title' => '', 'card_content' => '', 'card_link_text' => '', 'card_link' => '#'])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
    <div class="flex items-start gap-4">
        <div class="flex-shrink-0 p-3 bg-blue-50/50 rounded-lg">
            @antlers
                {{iconify:icon class="h-6 w-6 text-blue-900/90"}}
            @endantlers
        </div>
        <div class="flex-1 min-w-0">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $card_title }}</h3>
            <p class="text-gray-600 mb-4">{{ $card_content }}</p>
            @if ($card_link_text && $card_link)
                <a href="{{ $card_link }}"
                    class="inline-flex items-center text-blue-900/90 hover:text-blue-800 font-medium">
                    {{ $card_link_text }}
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</div>
