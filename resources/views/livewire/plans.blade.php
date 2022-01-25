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
            <h1 class="font-bold text-2xl">My Plans</h1>
            <x-element.button
                label="New Plan"
                icon="fas fa-plus-circle"
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
            <x-form.plan />
        </x-modal.base>
    </div>

    <livewire:filters
        :show="$show"
        :sort-by="$sortBy"
        :sort-order="$sortOrder"
        :sort-options="$sortOptions"
        :total-results="$totalResults"
    />

    <x-card.wrapper>
        @foreach ($plans as $plan)
            <x-card.plan
                :plan="$plan"
                is-mine
            />
        @endforeach
    </x-card.wrapper>

    <div class="mt-6">
        {{ $plans->links() }}
    </div>
</div>
