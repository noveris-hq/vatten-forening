<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera - Medlemsportal</title>
    @vite(['resources/css/site.css', 'resources/js/site.js'])
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                {{-- <x-icon name="droplets" class="h-10 w-10 text-blue-600" /> --}}
                <h1 class="text-2xl font-serif font-bold text-gray-900">Östra Karbäcken</h1>
            </div>
            <h2 class="text-xl text-gray-600">Medlemsregistrering</h2>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Skapa konto</h3>

            {{-- @if ($errors->any()) --}}
            {{--     <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg"> --}}
            {{--         <ul class="list-disc list-inside text-sm text-red-800"> --}}
            {{--             @foreach ($errors->all() as $error) --}}
            {{--                 <li>{{ $error }}</li> --}}
            {{--             @endforeach --}}
            {{--         </ul> --}}
            {{--     </div> --}}
            {{-- @endif --}}

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Namn<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        @error('name') input-error @enderror"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-black focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror

                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        E-postadress<span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Telefonnummer
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="street_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Adress<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="street_name" name="street_name" value="{{ old('street_name') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">
                        Postnummer<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                        Ort<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="property_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Fastighetsnummer<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="property_number" name="property_number" placeholder="ex. 1:56"
                        value="{{ old('property_number') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Lösenord<span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Bekräfta lösenord<span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium hover:cursor-pointer">
                    Registrera
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Redan medlem?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Logga in här
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
