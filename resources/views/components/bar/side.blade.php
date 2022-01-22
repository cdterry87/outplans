<div
    x-cloak
    x-data="{ isSidebarHidden: true }"
    class="
        flex
        md:items-stretch
        h-screen
        min-h-screen
        w-full
        md:w-72
        absolute
        md:static
        left-0
        transform
        transition
        duration-200
        ease-in-out
        z-40
        "
    :class="{'-translate-x-full md:-translate-x-0': isSidebarHidden}"
    @toggle-sidebar.window="isSidebarHidden = !isSidebarHidden"
>
    <div
        class="
        bg-indigo-700
        border-r-8 border-indigo-900
        text-white
        w-full
        p-8">
        <div class="flex justify-between text-2xl">
            <h1 class="font-bold"><a href="{{ route('home') }}">Outplans</a></h1>
            <div class="md:hidden">
                <i
                    class="md:hidden fas fa-times text-white cursor-pointer"
                    @click.prevent="isSidebarHidden = true"
                ></i>
            </div>
        </div>
        <div class="flex flex-col gap-1 bg-white rounded mt-2 p-3 text-black">
            <h2 class="text-sm">
                Welcome,<br> <span class="text-lg font-bold">{{ Auth::user()->name }}</span>
            </h2>
            <div class="text-xs">
                <a href="{{ route('profile.show') }}">My Profile</a>
                <span class="mx-2">|</span>
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="inline-block"
                >
                    @csrf
                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
        <hr class="my-4" />
        <div class="flex flex-col h-full justify-between gap-4">
            <div>
                <ul class="text-lg space-y-3">
                    <li>
                        <a
                            href="{{ route('dashboard') }}"
                            class="block w-full hover:opacity-80"
                        >
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('plans') }}"
                            class="block w-full hover:opacity-80"
                        >
                            <i class="fas fa-calendar-alt mr-2"></i> Plans
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('invites') }}"
                            class="block w-full hover:opacity-80"
                        >
                            <i class="fas fa-user-plus mr-2"></i> Invites
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('attended') }}"
                            class="block w-full hover:opacity-80"
                        >
                            <i class="fas fa-history mr-2"></i> Attended
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('friends') }}"
                            class="block w-full hover:opacity-80"
                        >
                            <i class="fas fa-users mr-2"></i> Friends
                        </a>
                    </li>
                </ul>
            </div>
            <div class="text-xs">&copy; Outplans 2021</div>
        </div>
    </div>
</div>
