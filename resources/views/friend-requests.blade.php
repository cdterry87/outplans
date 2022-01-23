<x-app-layout>
    <div
        class="
        flex flex-col
        space-y-2
        md:flex-row
        lg:space-y-0
        items-center
        justify-between
        gap-2 md:gap-8
        mb-4
      ">
        <div class="w-full flex flex-row items-center gap-4 md:flex-col md:items-start lg:flex-row lg:items-center">
            <h1 class="font-bold text-2xl">Friend Requests</h1>
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
                <option value="ca">Name (Asc)</option>
                <option value="cd">Name (Desc)</option>
                <option value="da">Date (Asc)</option>
                <option value="dd">Date (Desc)</option>
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
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
        <x-card.user friend-request />
    </x-card.wrapper>
</x-app-layout>
