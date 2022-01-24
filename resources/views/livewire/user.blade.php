<div>
    <div
        class="
        flex flex-col
        lg:flex-row
        items-center
        lg:items-end
        justify-between
        gap-4
        border-b border-gray-200
        pb-4
      ">
        <div class="flex flex-col items-center md:flex-row md:items-end gap-4">
            <img
                src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=50?d=mm"
                alt="Avatar"
                class="rounded-full w-24 h-24 shadow-md"
            />
            <div class="flex flex-col">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <div class="text-indigo-700">
                    <div class="text-xs">Member since {{ $user->created_at }}</div>
                </div>
                @if (!$user->isMe())
                    <div class="mt-2">
                        <x-element.button
                            v-if="isFriend"
                            label="Remove Friend"
                            small
                            danger
                        />
                        <x-element.button
                            v-else
                            label="Add Friend"
                            small
                            success
                        />
                    </div>
                @endif
            </div>
        </div>
        <div
            v-if="!isPrivate"
            class="
          flex
          items-end
          justify-end
          gap-6
          text-gray-600
          border-t border-gray-200
          pt-4
          px-4
        "
        >
            <label
                class="hover:text-indigo-700 cursor-pointer"
                :class="{
            'font-bold text-indigo-700': selection === 'plans'
          }"
            >
                <input
                    class="hidden"
                    v-model="selection"
                    type="radio"
                    name="selection"
                    value="plans"
                />
                Plans
            </label>
            <label
                class="hover:text-indigo-700 cursor-pointer"
                :class="{
            'font-bold text-indigo-700': selection === 'attending'
          }"
            >
                <input
                    class="hidden"
                    v-model="selection"
                    type="radio"
                    name="selection"
                    value="attending"
                />
                Attending
            </label>
            <label
                class="hover:text-indigo-700 cursor-pointer"
                :class="{
            'font-bold text-indigo-700': selection === 'attended'
          }"
            >
                <input
                    class="hidden"
                    v-model="selection"
                    type="radio"
                    name="selection"
                    value="attended"
                />
                Attended
            </label>
        </div>
    </div>
    <div
        v-if="isPrivate"
        class="
        flex flex-col
        items-center
        justify-center
        gap-2
        text-gray-600
        my-12
      "
    >
        <i class="fas fa-lock text-8xl text-gray-200"></i>
        <p class="font-bold text-lg">This account is private.</p>
        <p class="text-md">You will not be able to view this user's profile.</p>
    </div>
    <div
        v-else
        class="mt-4"
    >
        {{-- <div v-show="selection === 'plans'">
            <h2 class="text-xl font-bold mb-4">John's Plans</h2>
            <x-card.wrapper>
                <x-card.plan />
                <x-card.plan />
            </x-card.wrapper>
        </div>
        <div v-show="selection === 'attending'">
            <h2 class="text-xl font-bold mb-4">Attending</h2>
            <x-card.wrapper>
                <x-card.plan />
            </x-card.wrapper>
        </div>
        <div v-show="selection === 'attended'">
            <h2 class="text-xl font-bold mb-4">Attended</h2>
            <x-card.wrapper>
                <x-card.plan />
                <x-card.plan />
                <x-card.plan />
                <x-card.plan />
            </x-card.wrapper>
        </div> --}}
    </div>
</div>
