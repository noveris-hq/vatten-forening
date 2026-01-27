@extends('admin.layout')

<x-dashboard-nav />
@section('content')
    <main class="container max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Redigera medlem</h1>

        <form action="{{ route('medlemmar.update', $user->id) }}" method="POST"
            class="bg-white rounded border border-gray-300 px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Namn</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class=" border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-post</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class=" border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Telefon</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                    class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="property_number" class="block text-gray-700 text-sm font-bold mb-2">Fastighetsnummer</label>
                    <input type="text" name="property_number" id="property_number"
                        value="{{ old('property_number', $user->property_number) }}"
                        class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('property_number')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="postal_code" class="block text-gray-700 text-sm font-bold mb-2">Postnummer</label>
                    <input type="text" name="postal_code" id="postal_code"
                        value="{{ old('postal_code', $user->postal_code) }}"
                        class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('postal_code')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="street_name" class="block text-gray-700 text-sm font-bold mb-2">Gatuadress</label>
                <input type="text" name="street_name" id="street_name"
                    value="{{ old('street_name', $user->street_name) }}"
                    class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('street_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">Stad</label>
                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                    class="border rounded border-gray-300 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('city')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="payment_status" class="block text-gray-700 text-sm font-bold mb-2">Medlemsstatus</label>
                    <select name="payment_status" id="payment_status"
                        class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="paid"
                            {{ old('payment_status', $user->payment_status) === 'paid' ? 'selected' : '' }}>Betald
                        </option>
                        <option value="unpaid"
                            {{ old('payment_status', $user->payment_status) === 'unpaid' ? 'selected' : '' }}>Obetald
                        </option>
                        <option value="overdue"
                            {{ old('payment_status', $user->payment_status) === 'overdue' ? 'selected' : '' }}>
                            Försenad</option>
                    </select>
                    @error('payment_status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <div class="mb-4"> --}}
                {{--     <label for="balance" class="block text-gray-700 text-sm font-bold mb-2">Saldo</label> --}}
                {{--     <input type="number" step="0.01" name="balance" id="balance" --}}
                {{--         value="{{ old('balance', $user->balance) }}" --}}
                {{--         class="border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"> --}}
                {{--     @error('balance') --}}
                {{--         <p class="text-red-500 text-xs italic">{{ $message }}</p> --}}
                {{--     @enderror --}}
                {{-- </div> --}}
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Uppdatera medlem
                </button>
                <a href="{{ route('medlemmar.index') }}"
                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Tillbaka
                </a>
            </div>
        </form>
    </main>
@endsection
