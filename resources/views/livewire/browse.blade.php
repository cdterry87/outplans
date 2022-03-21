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
            <h1 class="font-bold text-2xl">Browse Plans</h1>
        </div>
    </div>

    <livewire:filters
        :show="$show"
        :sort-by="$sortBy"
        :sort-order="$sortOrder"
        :sort-options="$sortOptions"
        :total-results="$totalResults"
    />

    <x-card.wrapper>
        @forelse ($plans as $plan)
            <x-card.plan :plan="$plan" />
        @empty
            <x-card.empty>
                Sorry, we couldn't find any plans. Please check back later.
            </x-card.empty>
        @endforelse
    </x-card.wrapper>

    <div class="mt-6">
        {{ $plans->links() }}
    </div>
</div>
