<form>
    <div class="flex items-center justify-between gap-4">
        <h2 class="text-3xl font-bold">Search for Friends</h2>
        <div class="flex gap-2">
            <x-element.button
                label="Cancel"
                secondary
                wire:click.prevent="closeModal"
            />
        </div>
    </div>

    <hr class="my-4">

    @if (session()->has('success-message'))
        <p class="text-lg text-green-600 text-center">{{ session('success-message') }}</p>
    @endif

    @if ($this->isSearchComplete)
        <div class="flex flex-col items-center justify-center text-center">
            <div class="my-4">
                @if ($this->friend_name)
                    <p class="text-xl">Add "<strong>{{ $this->friend_name }}</strong>" as a friend?</p>
                    @error('friend_id')
                        <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                    @enderror
                @else
                    <p class="text-xl">Sorry, we couldn't find that person.</p>
                    <p class="text-sm">Please try searching again.</p>
                @endif
            </div>
            <div class="w-full flex flex-col md:flex-row md:items-center gap-4 py-4">
                @if ($this->friend_id)
                    <x-element.button
                        label="Add Friend"
                        icon="fas fa-user-plus"
                        success
                        wire:click.prevent="addFriend"
                        full-width
                    />
                @endif
                <x-element.button
                    label="Cancel"
                    icon="fas fa-times"
                    danger
                    wire:click.prevent="cancelAddFriend"
                    full-width
                />
            </div>
        </div>
    @else
        <div class="flex flex-col md:flex-row justify-center gap-4 py-4">
            <div class="w-full md:w-2/3">
                <x-input.text
                    label="Search for a friend by email address"
                    name="friend_email"
                    wire:model="friend_email"
                    placeholder="Your friend's email address"
                    hidden-label
                    full-width
                />
            </div>
            <div class="w-full md:w-1/3">
                <x-element.button
                    label="Search"
                    icon="fas fa-search"
                    primary
                    wire:click.prevent="friendSearch"
                    full-width
                />
            </div>
        </div>
    @endif
</form>
