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
            <h1 class="font-bold text-2xl">My Upcoming Plans</h1>
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
        @forelse ($upcomingPlans as $upcomingPlan)
            <x-card.plan :plan="$upcomingPlan->plan" />
        @empty
            <x-card.empty>
                Sorry, we couldn't find any plans. Please check back later.
            </x-card.empty>
        @endforelse
    </x-card.wrapper>

    <div class="mt-6">
        {{ $upcomingPlans->links() }}
    </div>
</div>
