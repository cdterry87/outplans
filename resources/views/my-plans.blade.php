<x-app-layout>
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
        <div
            class="w-full flex flex-col gap-4 sm:flex-row sm:justify-center sm:items-center md:flex-col md:justify-start md:items-start lg:flex-row lg:justify-center lg:items-center">
            <x-input.select
                label="Sort"
                name="sort"
                id="sort"
                hidden-label
                full-width
            >
                <option value="">Sort by</option>
                <option value="ca">Cost (Asc)</option>
                <option value="cd">Cost (Desc)</option>
                <option value="da">Date (Asc)</option>
                <option value="dd">Date (Desc)</option>
                <option value="ga"># Going (Asc)</option>
                <option value="gd"># Going (Desc)</option>
            </x-input.select>
            <x-input.text
                label="Search"
                type="search"
                placeholder="Search for plans..."
                hidden-label
                full-width
            />
        </div>
    </div>
    <x-card.wrapper>
        <x-card.plan is-mine />
        <x-card.plan is-mine />
        <x-card.plan is-mine />
        <x-card.plan is-mine />
    </x-card.wrapper>
</x-app-layout>
