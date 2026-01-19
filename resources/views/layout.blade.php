<!doctype html>
<html lang="sv">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $page->title ?? $title }}</title>
    @livewireStyles
    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>

<body class="min-h-screen flex flex-col bg-white">
    @if (session('success'))
        <div id="toast-simple"
            class="flex items-center w-full max-w-sm p-4 text-body bg-neutral-primary-soft rounded-base shadow-xs border border-default"
            role="alert">
            <svg class="w-5 h-5 text-fg-brand" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5" />
            </svg>
            <div class="ms-2.5 text-sm border-s border-default ps-3.5"> <span>{{ session('success') }}</span></div>

            <button type="button"
                class="ms-auto flex items-center justify-center text-body hover:text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none"
                data-dismiss-target="#toast-simple" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>
        {{-- <div class="toast toast-top toast-center"> --}}
        {{--     <div class="alert alert-success animate-fade-out"> --}}
        {{--         <svg xmlns="<http://www.w3.org/2000/svg>" class="h-6 w-6 shrink-0 stroke-current" fill="none" --}}
        {{--             viewBox="0 0 24 24"> --}}
        {{--             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" --}}
        {{--                 d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /> --}}
        {{--         </svg> --}}
        {{--         <span>{{ session('success') }}</span> --}}
        {{--     </div> --}}
        {{-- </div> --}}
    @endif

    <!-- Error Toast -->
    @if (session('error'))
        <div class="toast toast-top toast-center">
            <div class="alert alert-error animate-fade-out">
                <svg xmlns="<http://www.w3.org/2000/svg>" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="toast toast-top toast-center">
            <div class="alert alert-error animate-fade-out">
                <svg xmlns="<http://www.w3.org/2000/svg>" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif

    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
    @livewireScripts
</body>

</html>
