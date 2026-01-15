@props(['user' => null])

<div class="mb-8">
    <h1 class="text-3xl font-bold text-foreground">Välkommen {{ $user->name }}! {{ $user->is_admin }}</h1>
    <p class="text-muted-foreground mt-1">
        Här kan du se dokument, nyheter och hantera din medlemsavgift.
    </p>
</div>
