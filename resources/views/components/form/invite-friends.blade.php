@props(['friends', 'invites'])

<form>
    <div class="flex items-center justify-between gap-4">
        <h2 class="text-3xl font-bold">Plan</h2>
        <div class="flex gap-2">
            <x-element.button
                label="Cancel"
                secondary
                wire:click.prevent="closeModal"
            />
        </div>
    </div>
    <hr class="my-4">
    <div class="w-full my-4 px-2">
        <x-input.search
            placeholder="Search for friends"
            full-width
            wire:input.debounce.500ms="filterSearch($event.target.value)"
        />
    </div>
    @forelse ($friends as $friend)
        <div class="flex justify-between items-center gap-4 p-2">
            <div class="text-sm sm:text-lg w-full">
                <label
                    class="block w-full"
                    for="friend_{{ $friend->id }}"
                >
                    {{ $friend->name }}
                </label>
            </div>
            <div>
                @if (in_array($friend->id, $invites))
                    <x-element.button
                        label="Uninvite"
                        danger
                        small
                        wire:click.prevent="uninvite({{ $friend->id }})"
                    />
                @else
                    <x-element.button
                        label="Invite"
                        success
                        small
                        wire:click.prevent="invite({{ $friend->id }})"
                    />
                @endif
            </div>
        </div>
    @empty
        You haven't added any friends yet.
    @endforelse
</form>
