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
        <div class="w-full flex flex-wrap items-center gap-4 md:items-start lg:flex-row lg:items-center">
            <h1 class="font-bold text-2xl">My Friends</h1>
            <x-element.button
                label="Add Friend"
                icon="fas fa-user-plus"
                primary
                wire:click="openModal"
            />
        </div>
    </div>

    <div
        x-cloak
        x-data="{isModalOpen: @entangle('isModalOpen')}"
        @keydown.window.escape="isModalOpen = false"
    >
        <x-modal.base>
            <x-form.add-friend />
        </x-modal.base>
    </div>

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
