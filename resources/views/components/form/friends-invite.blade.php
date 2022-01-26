@props(['friends'])

<form wire:submit.prevent="submit">
    <div class="flex items-center justify-between gap-4">
        <h2 class="text-3xl font-bold">Plan</h2>
        <div class="flex gap-2">
            <x-element.button
                label="Invite"
                icon="fas fa-plus"
                primary
            />
            <x-element.button
                label="Cancel"
                secondary
                wire:click.prevent="closeModal"
            />
        </div>
    </div>
    <hr class="my-4">
    <div class="w-full my-4 px-2">
        <x-input.text
            type="search"
            placeholder="Search for friends"
            full-width
        />
    </div>
    @forelse ($friends as $friend)
        <div class="flex justify-between items-center gap-4 p-2">
            <div class="text-lg w-full">
                <label
                    class="block w-full"
                    for="friend_{{ $friend->id }}"
                >
                    {{ $friend->name }}
                </label>
            </div>
            <div>
                <x-input.checkbox
                    large
                    name="friends[]"
                    id="friend_{{ $friend->id }}"
                    value="{{ $friend->id }}"
                    wire:model="selectedFriends"
                />
            </div>
        </div>
    @empty
        You haven't added any friends yet.
    @endforelse
</form>
