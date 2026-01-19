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

<body class="min-h-screen flex flex-col bg-gray-50">
    @include('partials.navbar')
    @yield('content')
    @livewireScripts
    <x-notify::notify />
    @stack('scripts')
</body>

</html>
