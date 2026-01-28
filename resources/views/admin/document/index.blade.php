@extends('admin.layout')

@section('content')

    <x-dashboard-nav />

    <div class="container mx-auto px-4 py-8">

        <div class="max-w-3xl mx-auto">

            @session('success')
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-green-800 font-medium">{{ $value }}</span>
                </div>
            @endsession

            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-8">

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Ladda upp dokument</h2>
                        <p class="text-gray-500 dark:text-gray-400">Ladda upp dina dokument säkert till plattformen</p>
                    </div>

                    <form action="{{ route('admin.document.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4">
                                <label for="file-input"
                                    class="bg-blue-900/90 hover:cursor-pointer text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="5" height="5"
                                        class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-upload h-8 w-8 mx-auto text-muted-foreground mb-2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" x2="12" y1="3" y2="15"></line>
                                    </svg>
                                    Välj fil
                                </label>

                                <input type="file" id="file-input" name="file" accept=".pdf,.xlsx,.csv,.docx"
                                    @error('name') input-error @enderror" class="hidden" />
                                {{-- @error('file-input') --}}
                                {{--     <div class="label -mt-4 mb-2"> --}}
                                {{--         <span class="label-text-alt text-error">{{ $message }}</span> --}}
                                {{--     </div> --}}
                                {{-- @enderror --}}


                                <div id="file-name-display"
                                    class="mt-3 sm:mt-0 text-sm text-gray-700 dark:text-gray-300 hidden">
                                    Vald fil: <span id="file-name-text" class="font-medium text-indigo-700"></span>
                                </div>
                            </div>
                            <select name="category" id="category" @error('category') input-error @enderror"
                                class="dark:bg-gray-800 mt-3 sm:mt-0 block w-full sm:w-auto border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" disabled selected>Välj kategori</option>
                                <option value="yearly-rapport">Årsrapport</option>
                                <option value="protocoll">Protokoll</option>
                                <option value="invoices">Fakturor</option>
                            </select>

                            <select name="year" id="year" @error('year') input-error @enderror"
                                class="mt-3 sm:mt-0 block dark:bg-gray-800 w-full sm:w-auto border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" disabled selected>Välj år</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            {{-- @error('category') --}}
                            {{--     <div class="label -mt-4 mb-2"> --}}
                            {{--         <span class="label-text-alt text-red-400">{{ $message }}</span> --}}
                            {{--     </div> --}}
                            {{-- @enderror --}}


                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Tillåtna format: PDF, XLSX, CSV, DOCX • Max 10 MB
                            </p>

                            @error('category')
                                <div class="p-3 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2 text-sm">
                                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-red-800">{{ $message }}</span>
                                </div>
                            @enderror

                            @error('file')
                                <div class="p-3 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2 text-sm">
                                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-red-800">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="mt-10 flex items-center justify-between pt-6 border-t border-gray-100">
                            <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                Dina filer är krypterade och säkra
                            </div>

                            <button type="submit"
                                class="bg-blue-900/90 hover:cursor-pointer mt-6 text-white inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-900/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                Ladda upp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mt-12 mb-6">Uppladdade dokument</h1>
        <x-documents-table :groupedDocuments="$groupedDocuments" />


    </div>

    @push('scripts')
        <script>
            // This will show the selected file name when a file is chosen
            document.addEventListener('DOMContentLoaded', () => {
                const input = document.getElementById('file-input');
                const display = document.getElementById('file-name-display');
                const nameSpan = document.getElementById('file-name-text');

                if (!input || !display || !nameSpan) return;

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    console.log(file);
                    if (file) {
                        nameSpan.textContent = file.name;
                        display.classList.remove('hidden');
                    } else {
                        display.classList.add('hidden');
                        nameSpan.textContent = '';
                    }
                });
            });
        </script>
    @endpush

@endsection
