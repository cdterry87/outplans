<div x-data="{isModalOpen: @entangle('isModalOpen')}">
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
            <h1 class="font-bold text-2xl">My Plans</h1>
            <x-element.button
                label="New Plan"
                icon="fas fa-plus-circle"
                primary
                wire:click="openModal"
            />
        </div>
    </div>

    <x-modal.base>
        <x-form.plan />
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
            <x-form.delete-confirmation message="Are you sure you want to delete this plan?" />
        </div>
    @endif

    <x-card.wrapper>
        @forelse ($plans as $plan)
            <x-card.plan
                :plan="$plan"
                can-edit
            />
        @empty
            <x-card.empty>
                You do not currently have any plans.
            </x-card.empty>
        @endforelse
    </x-card.wrapper>

    <div class="mt-6">
        {{ $plans->links() }}
    </div>
</div>
