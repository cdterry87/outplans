<div
    class="
      flex flex-col
      bg-indigo-700
      border-r-8 border-indigo-900
      text-white
      w-full
      p-8
      gap-4
    "
    x-data="{ isSidebarHidden: true }"
    @toggle-sidebar.window="isSidebarHidden = !isSidebarHidden"
>
    <div class="flex justify-between text-2xl">
        <h1 class="font-bold"><a href="{{ route('home') }}">Outplans</a></h1>
        <div class="md:hidden">
            <i
                class="md:hidden fas fa-times text-black text-3xl absolute right-6 top-4 cursor-pointer"
                @click.prevent="isSidebarHidden = true"
            ></i>
        </div>
    </div>
    <hr />
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
