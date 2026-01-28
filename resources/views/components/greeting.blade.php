@props(['user' => null])

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Välkommen {{ $user->name }}!</h1>
    <p class="text-gray-500 dark:text-gray-400">
        Här kan du se dokument, nyheter och hantera din medlemsavgift.
    </p>
</div>
