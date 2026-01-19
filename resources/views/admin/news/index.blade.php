@extends('admin.layout')

@section('content')
    <x-dashboard-nav />
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Hantera Nyheter</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('nyheter.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Skapa ny nyhet
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Titel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Innehåll</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Datum</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Viktig</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Åtgärder</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($news as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">
                                {{ $item->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">
                                {{ Str::limit($item->content, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">
                                {{ $item->created_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">
                                {{ $item->is_important ? 'Ja' : 'Nej' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-b">
                                <a href="{{ route('nyheter.edit', $item->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Redigera</a>
                                <form action="{{ route('nyheter.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Är du säker att du vill radera denna nyhet?')"
                                        class="text-red-600 hover:text-red-900">Radera</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $news->links() }}
    </main>
@endsection
