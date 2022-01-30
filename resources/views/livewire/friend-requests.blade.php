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
            <h1 class="font-bold text-2xl">Friend Requests</h1>
        </div>
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
            <x-form.delete-confirmation message="Are you sure you want to delete this friend request?" />
        </div>
    @endif

    <x-card.wrapper>
        @forelse ($friendRequests as $user)
            <x-card.user
                :user="$user"
                friend-request
            />
        @empty
            <x-card.empty>
                You do not currently have any friend requests.
            </x-card.empty>
        @endforelse
    </x-card.wrapper>

    <div class="mt-6">
        {{ $friendRequests->links() }}
    </div>
</div>
