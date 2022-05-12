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
                        @if ($user->isFriend())
                            <x-element.button
                                label="Remove Friend"
                                small
                                danger
                            />
                        @else
                            <x-element.button
                                label="Add Friend"
                                small
                                success
                            />
                        @endif
                    </div>
                @endif
            </div>
        </div>
        {{-- @if (!$private)
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
        @endif --}}
    </div>
    @if ($private)
        <div class=" flex flex-col items-center justify-center gap-2 text-gray-600 my-12">
            <i class="fas fa-lock text-8xl text-gray-200"></i>
            <p class="font-bold text-lg">This account is private.</p>
            <p class="text-md">You will not be able to view this user's profile.</p>
        </div>
    @else
        <div class="mt-4">
            <h2 class="text-xl font-bold mb-4">Public Plans</h2>

            <x-card.wrapper>
                @forelse ($user->getPublicPlans() as $plan)
                    <x-card.plan :plan="$plan" />
                @empty
                    <x-card.empty>
                        This user does not have any public plans.
                    </x-card.empty>
                @endforelse
            </x-card.wrapper>
        </div>
    @endif
</div>
