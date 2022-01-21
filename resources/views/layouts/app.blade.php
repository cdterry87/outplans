<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;400;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="{{ mix('css/app.css') }}"
    >

    @livewireStyles

    <!-- Scripts -->
    <script
        src="{{ mix('js/app.js') }}"
        defer
    ></script>
</head>

<body class="font-sans antialiased">
    <div class="relative flex">
        <x-bar.side @close-sidebar="onCloseSidebar" />
        <div
            class="
                bg-gray-100
                flex-1 flex flex-col
                justify-between
                gap-4
                min-h-screen
                h-screen
                overflow-scroll
              ">
            <div class="flex flex-col gap-4 min-h-screen h-full">
                <x-bar.header @open-sidebar="onOpenSidebar" />
                <div class="flex-1 px-8 pb-8">
                    {{ $slot }}
                </div>
                <x-bar.footer />
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
