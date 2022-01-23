<div
    class="w-full flex flex-col gap-4 sm:flex-row sm:justify-center sm:items-center md:flex-col md:justify-start md:items-start lg:flex-row lg:justify-center lg:items-center">
    <x-input.select
        label="Sort by"
        name="sort_by"
        id="sort_by"
        hidden-label
        wire:model="sortBy"
        wire:change="updateSortBy"
    >
        <option value="">Sort by</option>
        <option value="when">Date</option>
        <option value="cost">Cost</option>
        <option value="title">Title</option>
    </x-input.select>
    <x-input.select
        label="Sort Order"
        name="sort_order"
        id="sort_order"
        hidden-label
        wire:model="sortOrder"
        wire:change="updateSortOrder"
    >
        <option value="">Sort order</option>
        <option value="asc">Asc</option>
        <option value="desc">Desc</option>
    </x-input.select>
    <x-input.text
        label="Search"
        type="search"
        placeholder="Search for plans..."
        hidden-label
        full-width
        wire:model="search"
        wire:input.debounce.500ms="updateSearch"
    />
</div>
