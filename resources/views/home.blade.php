<x-guest-layout>
    <div class="min-h-screen">
        <x-bar.hero>
            <div class="flex items-center justify-end text-white">
                <nav class="flex items-center gap-6">
                    <a href="{{ route('login') }}"> Login </a>
                    <a href="{{ route('register') }}"> Register </a>
                </nav>
            </div>
            <div
                class="
              h-full
              flex flex-col
              md:flex-row
              items-center
              justify-center
              text-center
              gap-12
            ">
                <div class="flex flex-col gap-4 text-white">
                    <h1 class="text-6xl sm:text-8xl font-bold">Outplans</h1>
                    <h2>
                        Making and sharing plans with your friends has never been simpler!
                    </h2>
                    <div class="mt-8">
                        <x-element.button
                            href="{{ route('register') }}"
                            label="Get Started!"
                            styles="font-bold"
                            padding="px-16 py-3"
                            animated
                        />
                    </div>
                </div>
            </div>
        </x-bar.hero>

        <x-bar.footer />
    </div>
</x-guest-layout>
