<div
    x-data="{ showFilters: false }"
    {{-- class="bg-gray-200 border border-gray-300 shadow-md rounded-lg p-4 my-6" --}}
    class="bg-indigo-700 border border-indigo-900 text-gray-200 shadow-md rounded-lg p-4 my-6"
>
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm gap-2 sm:gap-4 font-bold select-none">
        <h4 class="flex items-center">
            Found
            <span class="text-2xl font-bold text-white mx-2">{{ $totalResults }}</span>
            Results
        </h4>
        <a
            href="#"
            @click.prevent="showFilters = !showFilters"
        >
            Show Filters
            <i
                class="fas"
                :class="showFilters ? 'fa-chevron-up' : 'fa-chevron-down'"
            ></i>
        </a>
    </div>

    <div
        x-cloak
        x-show="showFilters"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="flex flex-col lg:flex-row lg:justify-between gap-2 lg:gap-4 mt-4"
    >
        <div class="flex flex-col lg:flex-row lg:items-center gap-2">
            <x-input.select
                label="Show"
                name="show"
                id="show"
                class="w-full lg:w-auto"
                wire:model="show"
                wire:change="updateShow"
            >
                <option value="">Show</option>
                <option value="6">6</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="60">60</option>
                <option value="120">120</option>
            </x-input.select>
            <x-input.select
                label="Sort by"
                name="sort_by"
                id="sort_by"
                class="w-full lg:w-auto"
                wire:model="sortBy"
                wire:change="updateSortBy"
            >
                <option value="">Sort by</option>
                @foreach ($sortOptions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-input.select>
            <x-input.select
                label="Sort Order"
                name="sort_order"
                id="sort_order"
                class="w-full lg:w-auto"
                wire:model="sortOrder"
                wire:change="updateSortOrder"
            >
                <option value="">Sort order</option>
                <option value="asc">Asc</option>
                <option value="desc">Desc</option>
            </x-input.select>

        </div>

        <x-input.search
            label="Search"
            type="search"
            placeholder="Search for plans..."
            class="w-full lg:w-auto"
            wire:input.debounce.500ms="$emit('filterSearch', $event.target.value)"
        />
    </div>
</div>
