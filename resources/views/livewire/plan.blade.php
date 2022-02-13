<div>
    {{-- Private plan --}}
    {{-- <div
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
        <p class="font-bold text-lg">This plan is private.</p>
        <p class="text-md">
            You will not be able to view this plan unless you are invited.
        </p>
    </div> --}}
    {{-- End private plan --}}

    {{-- Public plan --}}
    <div
        class="
        rounded-lg
        lg:rounded-tr-none lg:rounded-tl-3xl
        shadow-md
        bg-white
      ">
        <div class="flex flex-col lg:flex-row">
            <img
                src="{{ $plan->getDisplayImage() }}"
                class="
                    w-full
                    lg:w-3/5
                    h-80
                    object-cover
                    rounded-t-lg
                    lg:rounded-tr-none lg:rounded-tl-3xl lg:rounded-br-3xl
                "
            />
            <div
                class="
                    w-full
                    lg:w-2/5
                    flex flex-col
                    gap-8
                    justify-between
                    rounded-tr-lg
                    font-bold
                    px-8
                    pt-8
                ">
                <div>
                    <div class="text-indigo-700">{{ $plan->getFormattedDateRange() }}</div>
                    <div class="mt-6">
                        <span class="block text-2xl">{{ $plan->title }}</span>
                        <div class="font-normal text-gray-600 text-sm mt-2">
                            by
                            <a
                                class="text-indigo-700 font-bold"
                                href="{{ route('user', ['user' => $plan->user->id]) }}"
                            >
                                {{ $plan->user->name }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-6">
                    @if (!$plan->isMine())
                        <div
                            class="
                                flex flex-col
                                xl:flex-row
                                items-center
                                gap-4
                        ">
                            <x-element.button
                                label="I'm Going"
                                success
                                full-width
                            />
                            <x-element.button
                                label="I'm Not Going"
                                danger
                                full-width
                            />
                        </div>
                    @else
                        <x-element.button
                            label="Invite Friends"
                            primary
                            full-width
                            wire:click.prevent="openModal"
                        />
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div class="flex flex-col-reverse lg:flex-row">
                <div class="w-full lg:w-3/5 p-8">
                    <div class="text-justify text-gray-500 text-lg">
                        {{ $plan->description }}
                    </div>
                </div>
                <div class="flex flex-col gap-8 w-full lg:w-2/5 p-8">
                    <div>
                        <div class="text-gray-500">
                            <p class="font-bold text-indigo-700">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $plan->location }}
                            </p>
                            <div class="text-sm">
                                <p>{{ $plan->address }}</p>
                                <p>{{ $plan->city }}, {{ $plan->state }} {{ $plan->postal_code }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col gap-2 font-bold text-indigo-700">
                            <div>
                                <i class="fas fa-user-plus"></i> {{ count($invites) }} Invited
                            </div>
                            <div>
                                <i class="fas fa-users"></i> {{ $attendees_count }} Going
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                {{-- Map goes here --}}
            </div>
        </div>
    </div>
    {{-- End public plan --}}

    {{-- Friends Modal --}}
    <x-modal.base>
        <x-form.invite-friends
            :friends="$friends"
            :invites="$invites"
        />
    </x-modal.base>
    {{-- End Friends Modal --}}
</div>
