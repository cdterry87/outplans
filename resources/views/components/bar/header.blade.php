<div
    x-data
    class="flex items-center justify-between px-8 py-4"
>
    <div>
        {{-- Page title / breadcrumbs can go here --}}
    </div>
    <nav class="flex items-center text-xl sm:text-sm gap-4">
        <a href="{{ route('notifications') }}">
            <i class="fas fa-bell sm:hidden"></i>
            <span class="hidden sm:block"> Notifications </span>
        </a>
        <a
            class="md:hidden cursor-pointer"
            @click.prevent="$dispatch('toggle-sidebar')"
        >
            <i class="fas fa-bars"></i>
        </a>
    </nav>
</div>
