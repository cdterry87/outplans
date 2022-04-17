<div>
    <div
        class="
        flex flex-col
        md:flex-row
        items-center
        justify-between
        mb-4
        gap-4
        lg:gap-8
      ">
        <div class="w-full flex flex-wrap items-center justify-between gap-4 lg:flex-row">
            <div class="flex items-center flex-wrap gap-4">
                <h1 class="font-bold text-2xl">My Friends</h1>
                <x-element.button
                    label="Add Friend"
                    icon="fas fa-plus"
                    primary
                    wire:click="openModal"
                />
            </div>

            <a
                class="font-bold text-indigo-800"
                href="{{ route('friend-requests') }}"
            >
                <i class="fas fa-user-plus mr-2"></i> Friend Requests
            </a>
        </div>
    </div>

    <x-modal.base>
        <x-form.add-friend />
    </x-modal.base>

    <livewire:filters
        :show="$show"
        :sort-by="$sortBy"
        :sort-order="$sortOrder"
        :sort-options="$sortOptions"
        :total-results="$totalResults"
    />

    @if ($isDeleteConfirmationShown)
        <div class="my-6">
            <x-form.delete-confirmation message="Are you sure you want to remove this friend?" />
        </div>
    @endif

    <x-card.wrapper>
        @forelse ($friends as $friend)
            <x-card.user
                :user="$friend"
                friend
            />
        @empty
            <x-card.empty>
                You do not currently have any friends.
            </x-card.empty>
        @endforelse
    </x-card.wrapper>

    <div class="mt-6">
        {{ $friends->links() }}
    </div>
</div>
