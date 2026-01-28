@extends('admin.layout')

@section('content')
    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Uppdatera status
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('status.update') }}" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                @csrf
                @method('PUT')

                <!-- Radio buttons -->
                <fieldset class="space-y-4">
                    <legend class="text-lg font-medium text-gray-900">Aktuell status</legend>

                    <label class="flex items-start space-x-3">
                        <input type="radio" name="status" value="ok"
                            {{ old('status', $status->status) === 'ok' ? 'checked' : '' }}
                            class="mt-1 h-5 w-5 text-green-600 dark:text-green-400 border-gray-300 dark:border-gray-600 focus:ring-green-500">
                        <div>
                            <div class="font-medium">Allt fungerar</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Inga kända problem</div>
                        </div>
                    </label>

                    <label class="flex items-start space-x-3">
                        <input type="radio" name="status" value="warning"
                            {{ old('status', $status->status) === 'warning' ? 'checked' : '' }}
                            class="mt-1 h-5 w-5 text-amber-600 dark:text-amber-400 border-gray-300 dark:border-gray-600 focus:ring-amber-500">
                        <div>
                            <div class="font-medium">Driftsstörning</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Pågående problem som påverkar systemet</div>
                        </div>
                    </label>

                    <label class="flex items-start space-x-3">
                        <input type="radio" name="status" value="critical"
                            {{ old('status', $status->status) === 'critical' ? 'checked' : '' }}
                            class="mt-1 h-5 w-5 text-red-600 dark:text-red-400 border-gray-300 dark:border-gray-600 focus:ring-red-500">
                        <div>
                            <div class="font-medium">Avbrott</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Kritiskt fel - vattnet är avstängt</div>
                        </div>
                    </label>
                </fieldset>

                <!-- Message -->
                <div class="mt-8">
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Statusmeddelande
                    </label>
                    <textarea name="message" id="message" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('message', $status->message) }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Show on frontpage? -->
                {{-- <div class="mt-6"> --}}
                {{--     <label class="flex items-center"> --}}
                {{--         <input type="checkbox" name="is_public_message" value="1" --}}
                {{--             {{ old('is_public_message', $status->is_public_message) ? 'checked' : '' }} --}}
                {{--             class="h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500"> --}}
                {{--         <span class="ml-2 text-sm text-gray-700 dark:text-gray-300"> --}}
                {{--             Detta meddelande visas på startsidan för alla besökare --}}
                {{--         </span> --}}
                {{--     </label> --}}
                {{-- </div> --}}

                <!-- Actions -->
                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('status.show') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900">
                        Avbryt
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-900/90 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Spara ändringarsdasdasddddddd
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
