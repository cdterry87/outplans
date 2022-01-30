@props(['user', 'friend' => false, 'friendRequest' => false])

<div class="w-full lg:w-1/2 xl:w-1/3 flex flex-col p-3">
    <div
        class="
        flex flex-col
        gap-4
        bg-white
        border border-gray-100
        shadow-md
        rounded-lg
        p-4
      ">
        <div class="flex flex-col items-center justify-center gap-4">
            <img
                src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=50?d=mm"
                alt="Avatar"
                class="rounded-full w-12 h-12 shadow-md"
            />
            <div class="text-center">
                <a
                    href="#"
                    class="font-bold text-lg"
                >
                    {{ $user->name }}
                </a>
                <div class="text-sm text-gray-700">
                    {{ $user->email }}
                </div>
                <div class="text-indigo-700 text-xs">
                    @if ($friend)
                        Friends since {{ $user->friended_at }}
                    @else
                        Member since {{ $user->created_at }}
                    @endif
                </div>
            </div>
        </div>
        @if ($friend)
            <div class="flex justify-center mt-4">
                <x-element.button
                    label="Remove Friend"
                    small
                    danger
                    wire:click.prevent="deleteConfirmation({{ $user->id }})"
                />
            </div>
        @endif
        @if ($friendRequest)
            <div class="flex items-center justify-center gap-4">
                <x-element.button
                    label="Accept"
                    small
                    success
                    wire:click.prevent="acceptFriendRequest({{ $user->id }})"
                />
                <x-element.button
                    label="Delete"
                    small
                    danger
                    wire:click.prevent="deleteConfirmation({{ $user->id }})"
                />
            </div>
        @endif
    </div>
</div>
