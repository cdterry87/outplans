@props(['message'])

<div class="bg-white border border-gray-200 shadow-md rounded-md p-6 flex flex-col items-center justify-center gap-6">
    <div>{{ $message }}</div>
    <div class="flex items-center gap-4">
        <x-element.button
            label="Delete"
            danger
            wire:click.prevent="delete"
        />
        <x-element.button
            label="Cancel"
            wire:click.prevent="deleteCancellation"
        />
    </div>
</div>
