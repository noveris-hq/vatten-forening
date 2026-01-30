@props(['waterValves', 'markers', 'mapCenter'])
@vite(['resources/css/leaflet.css', 'resources/js/leaflet.js', 'resources/js/valve-map.js'])

<div class="space-y-6">
    <div class="px-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Ledningskarta</h1>
        <p class="text-gray-600 dark:text-gray-300">Översikt över vattenledningar och avstängare för varje fastighet</p>
    </div>
    <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800" id="valve-map">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3
                class="text-2xl font-semibold leading-none tracking-tight flex items-center gap-2 text-gray-900 dark:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-droplets h-5 w-5 text-blue-900 dark:text-blue-400">
                    <path
                        d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z">
                    </path>
                    <path
                        d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97">
                    </path>
                </svg>Vattenledningsnät
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Blå linje visar huvudledningen. Markörer visar varje
                fastighets avstängare.</p>
        </div>
        <div class="p-6 pt-0">
            <div id="map-container"
                class="h-[600px] rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 z-10">
            </div>
            <div class="mt-3 flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-1 bg-blue-600 rounded"></div><span>Vattenledning</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full bg-blue-600 border-2 border-white shadow"></div>
                    <span>Avstängare</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.mapData = {
            markers: {!! json_encode($markers) !!},
            mapCenter: {!! json_encode($mapCenter) !!}
        };
    </script>
@endpush
