@props([
    'plan' => null,
    'statusMessage' => '',
    'going' => false,
    'canEdit' => false,
    'attended' => false,
])

<div class="w-full lg:w-1/2 xl:w-1/3 flex flex-col p-3">
    @if ($plan->invited_by)
        <div class="bg-white rounded-t-lg border-x border-t border-gray-100 p-4">
            <a
                href="#"
                class="text-indigo-700 flex items-center gap-4"
            >
                <img
                    src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=50?d=mm"
                    alt="avatar"
                    class="rounded-full w-8 h-8 shadow-md"
                />
                <div>
                    Invited by
                    <strong>{{ $plan->invited_by }}</strong>
                </div>
            </a>
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-b-lg shadow-md">
        <div class="relative">
            @if (!$going && !$attended)
                @if (!$plan->isMine())
                    <div class="absolute top-3 right-3 flex items-center gap-3">
                        <x-element.plan-action
                            going
                            wire:click.prevent="attending({{ $plan->id }}, true)"
                        />
                        <x-element.plan-action
                            not-going
                            wire:click.prevent="attending({{ $plan->id }}, false)"
                        />
                    </div>
                @elseif($plan->isMine() && $canEdit)
                    <div class="absolute top-3 right-3 flex items-center gap-3">
                        <x-element.button
                            label="Edit"
                            icon="fas fa-edit"
                            success
                            small
                            wire:click.prevent="edit({{ $plan->id }})"
                        />
                        <x-element.button
                            label="Delete"
                            icon="fas fa-trash"
                            danger
                            small
                            wire:click.prevent="deleteConfirmation({{ $plan->id }})"
                        />
                    </div>
                @endif
            @endif
            <img
                src="{{ $plan->getDisplayImage() ?? null }}"
                class="w-full h-40 object-cover"
            />
            {{-- <div
                :class="{
                            'bg-green-500': going,
                            'bg-red-500': notGoing
                        }"
                class="
                        border-4 border-white
                        rounded-full
                        text-white
                        absolute
                        -bottom-4
                        left-1/2
                        transform
                        -translate-x-1/2
                        py-2
                        px-4
                        z-10
                        text-sm
                        font-bold
                        select-none
                        text-center
                        w-48
                    "
            >
                {{ $going ? 'You are going!' : 'You aren\'t going.' }}
            </div> --}}
        </div>
        <div class="flex flex-col gap-3 p-4 mt-2">
            <div class="font-bold">
                <a
                    href="{{ route('plan', $plan->id) }}"
                    class="block text-lg"
                >
                    {{ $plan->title }}
                </a>
                @if (!$plan->isMine())
                    <div class="text-gray-600 text-xs">
                        by {{ $plan->user->name }}
                    </div>
                @endif
            </div>
            <div class="flex flex-col gap-2 text-sm">
                <div class="font-bold text-indigo-700">{{ $plan->getFormattedDateRange() }}</div>
                <div class="text-gray-600">
                    <strong>{{ $plan->location }}</strong>
                    <p class="text-xs">{{ $plan->getFullAddress() }}</p>
                </div>
                <div class="flex items-center justify-between font-bold mt-2">
                    <div class="text-green-600">
                        @if ($plan->cost)
                            Cost:
                            <i class="fas fa-dollar-sign"></i>{{ $plan->cost }}
                        @else
                            Free
                        @endif
                    </div>
                    <div class="text-indigo-700">
                        <i class="fas fa-users"></i> {{ $plan->attendees_count ?? 0 }} Going
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
