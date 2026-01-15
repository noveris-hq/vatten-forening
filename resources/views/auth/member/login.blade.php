<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in - Medlemsportal</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                {{-- <x-icon name="droplets" class="h-10 w-10 text-blue-600" /> --}}
                <h1 class="text-2xl font-serif font-bold text-gray-900">Västra Karbäcken</h1>
            </div>
            <h2 class="text-xl text-gray-600">Medlemsportal</h2>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Logga in</h3>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-800">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        E-postadress
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Lösenord
                    </label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Kom ihåg mig</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700">
                        Glömt lösenord?
                    </a>
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Logga in
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Inte medlem än?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Registrera dig här
                    </a>
                </p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-gray-600 hover:text-gray-900">
                ← Tillbaka till startsidan
            </a>
        </div>
    </div>
</body>

</html>
