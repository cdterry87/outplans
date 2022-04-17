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
            <h1 class="font-bold text-2xl">My Attended Plans</h1>
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
        @forelse ($attendedPlans as $attendedPlan)
            <x-card.plan
                :plan="$attendedPlan->plan"
                attended
            />
        @empty
            <x-card.empty>
                Sorry, we couldn't find any plans you've attended. Please check back later after attending some plans.
            </x-card.empty>
        @endforelse
    </x-card.wrapper>

    <div class="mt-6">
        {{ $attendedPlans->links() }}
    </div>
</div>
