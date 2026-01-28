<!doctype html>
<html lang="sv">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }}</title>
    <script>
        // Theme detection script - runs before page render to prevent flash
        (function() {
            const theme = localStorage.getItem('theme') || 'system';
            const isDark = theme === 'dark' ||
                (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)')
                    .matches);
            if (isDark) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    @livewireStyles
    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>

<body class="min-h-screen flex flex-col bg-slate-50 dark:bg-gray-900">
    @if (!auth()->check())
        @include('partials.navbar')
    @endif
    @yield('content')
    @livewireScripts
    @stack('scripts')
</body>

</html>
