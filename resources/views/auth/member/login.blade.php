<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in - Medlemsportal</title>
    <script>
        // Theme detection script - runs before page render to prevent flash
        (function() {
            const theme = localStorage.getItem('theme') || 'system';
            const isDark = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDark) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>

<body class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                {{-- <x-icon name="droplets" class="h-10 w-10 text-blue-600" /> --}}
                <h1 class="text-2xl font-serif font-bold text-gray-900 dark:text-gray-100">Östra Karbäckens Vattenförening</h1>
            </div>
            <h2 class="text-xl text-gray-600 dark:text-gray-300">Medlemsportal</h2>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Logga in</h3>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg">
                    <p class="text-sm text-red-800 dark:text-red-300">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        E-postadress
                    </label>
                    <input type="email" id="email" name="email" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Lösenord
                    </label>
                    <input type="password" id="password" name="password"" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 bg-white dark:bg-gray-700">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Kom ihåg mig</span>
                    </label>

                    {{-- <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700"> --}}
                    {{--     Glömt lösenord? --}}
                    {{-- </a> --}}
                </div>

                <button type="submit"
                    class="hover:cursor-pointer w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Logga in
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Inte medlem än?
                    <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">
                        Registrera dig här
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">
                ← Tillbaka till startsidan
            </a>
        </div>
    </div>
</body>

</html>
