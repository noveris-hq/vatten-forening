@extends('admin.layout')

@section('content')

    <x-dashboard-nav />

    <div class="container mx-auto px-4 py-8">

        <div class="max-w-3xl mx-auto">

            @session('success')
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-green-800 font-medium">{{ $value }}</span>
                </div>
            @endsession

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8">

                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $title ?? 'Filuppladdning' }}</h2>
                        <p class="text-gray-500">Ladda upp dina dokument säkert till plattformen</p>
                    </div>

                    <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4">
                                <label for="file-input"
                                    class="hover:cursor-pointer inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-medium shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    Välj fil
                                </label>

                                <input type="file" id="file-input" name="file" accept=".pdf,.xlsx,.csv,.docx"
                                    class="hidden" />

                                <div id="file-name-display" class="mt-3 sm:mt-0 text-sm text-gray-700 hidden">
                                    Vald fil: <span id="file-name-text" class="font-medium text-indigo-700"></span>
                                </div>
                            </div>
                            <select name="category" id="category"
                                class="mt-3 sm:mt-0 block w-full sm:w-auto border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" disabled selected>Välj kategori</option>
                                <option value="yearly-rapport">Årsrapport</option>
                                <option value="protocoll">Protokoll</option>
                                <option value="invoices">Fakturor</option>
                            </select>

                            <p class="text-xs text-gray-500">
                                Tillåtna format: PDF, XLSX, CSV, DOCX • Max 10 MB
                            </p>

                            @error('file')
                                <div class="p-3 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2 text-sm">
                                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-red-800">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="mt-10 flex items-center justify-between pt-6 border-t border-gray-100">
                            <div class="text-sm text-gray-500 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                Dina filer är krypterade och säkra
                            </div>

                            <button type="submit"
                                class="hover:cursor-pointer inline-flex items-center px-8 py-3 bg-indigo-600 text-white rounded-xl font-semibold shadow-lg hover:bg-indigo-700 hover:shadow-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                Ladda upp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const input = document.getElementById('file-input');
                const display = document.getElementById('file-name-display');
                const nameSpan = document.getElementById('file-name-text');

                if (!input || !display || !nameSpan) return;

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
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
