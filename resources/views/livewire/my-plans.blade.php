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
        <div class="w-full flex flex-row items-center gap-4 md:flex-col md:items-start lg:flex-row lg:items-center">
            <h1 class="font-bold text-2xl">My Plans</h1>
            <x-element.button
                label="New Plan"
                icon="fas fa-plus-circle"
                primary
            />
        </div>
        <div class="w-full">
            <livewire:filters
                :sort-by="$sortBy"
                :sort-order="$sortOrder"
            />
        </div>
    </div>
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
