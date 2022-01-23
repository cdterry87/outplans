<div class="bg-gray-200 border border-gray-300 shadow-md rounded-lg p-4 my-6">
    <h4 class="font-bold text-xl mb-4">Found {{ $totalResults }} Results</h4>
    <div class="flex flex-col lg:flex-row lg:justify-between gap-2 lg:gap-4">
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

        <x-input.text
            label="Search"
            type="search"
            placeholder="Search for plans..."
            class="w-full lg:w-auto"
            wire:input.debounce.500ms="$emit('filterSearch', $event.target.value)"
        />
    </div>
</div>
