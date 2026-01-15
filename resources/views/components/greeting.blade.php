@props(['user' => null])

<div class="mb-8">
    <h1 class="text-3xl font-bold text-foreground">Välkommen {{ $user->name }}!</h1>
    <p class="text-gray-500">
        Här kan du se dokument, nyheter och hantera din medlemsavgift.
    </p>
</div>
