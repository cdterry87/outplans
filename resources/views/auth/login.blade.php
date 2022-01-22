<x-guest-layout>
    <div class="min-h-screen">
        <x-bar.hero>
            <div class="flex flex-col gap-4 items-center justify-center h-full">
                <div class="flex flex-col gap-1 text-white text-center">
                    <h1 class="text-6xl font-bold"><a href="{{ route('home') }}">Outplans</a></h1>
                    <p class="text-xl">Login and Start Making Plans!</p>
                </div>

                <div class="w-full sm:w-120 bg-white rounded shadow-md border-gray-200 p-8">
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                    >
                        @csrf

                        <div>
                            <x-jet-label
                                for="email"
                                value="{{ __('Email') }}"
                            />
                            <x-jet-input
                                id="email"
                                class="block mt-1 w-full"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                            />
                        </div>

                        <div class="mt-4">
                            <x-jet-label
                                for="password"
                                value="{{ __('Password') }}"
                            />
                            <x-jet-input
                                id="password"
                                class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />
                        </div>

                        <div class="block mt-4">
                            <label
                                for="remember_me"
                                class="flex items-center"
                            >
                                <x-jet-checkbox
                                    id="remember_me"
                                    name="remember"
                                />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a
                                    class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('password.request') }}"
                                >
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-jet-button class="ml-4">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </form>

                    <div class="text-center text-lg">
                        <hr class="my-6">
                        <a href="{{ route('register') }}">
                            {{ __('Or Create an Account!') }}
                    </div>
                </div>
            </div>
        </x-bar.hero>
        <x-bar.footer />
    </div>
</x-guest-layout>
