<form
    wire:submit.prevent="submit"
    enctype="multipart/form-data"
    class="flex flex-col gap-2 mt-2"
>
    <div class="flex items-center justify-between gap-4">
        <h2 class="text-3xl font-bold">Plan</h2>
        <div class="flex gap-2">
            <x-element.button
                label="Save Plan"
                primary
            />
            <x-element.button
                label="Cancel"
                secondary
                wire:click.prevent="closeModal"
            />
        </div>
    </div>

    <x-input.text
        label="Plan Title"
        name="title"
        full-width
        wire:model.defer="title"
    />
    <div class="flex flex-col sm:flex-row gap-4">
        <x-input.text
            label="Location Name"
            name="location"
            full-width
            wire:model.defer="location"
        />
        <x-input.text
            label="Address"
            name="address"
            full-width
            wire:model.defer="address"
        />
    </div>
    <div class="flex flex-col sm:flex-row gap-4">
        <x-input.text
            label="City"
            name="city"
            full-width
            wire:model.defer="city"
        />
        <x-input.select
            label="State"
            name="state"
            full-width
            wire:model.defer="state"
        >
            <option value="">Select State</option>
            @foreach ($states as $code => $value)
                <option value="{{ $code }}">{{ $value }}</option>
            @endforeach
        </x-input.select>
        <x-input.text
            label="Postal Code"
            name="postal_code"
            full-width
            wire:model.defer="postal_code"
        />
    </div>
    <x-input.textarea
        label="Description"
        name="description"
        full-width
        wire:model.defer="description"
    />
    <div class="flex flex-col sm:flex-row gap-4">
        <x-input.text
            label="Date/Time"
            name="when"
            type="datetime-local"
            full-width
            wire:model.defer="when"
        />
        <x-input.text
            label="Cost"
            name="cost"
            full-width
        />
    </div>
    <x-input.file
        label="Image"
        name="image"
        full-width
    />
</form>
