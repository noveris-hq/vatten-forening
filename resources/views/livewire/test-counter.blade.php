<div class="flex items-center gap-4">
    <button wire:click="decrement" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">-</button>
    <span class="text-xl font-semibold">{{ $count }}</span>
    <button wire:click="increment" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">+</button>
</div>
