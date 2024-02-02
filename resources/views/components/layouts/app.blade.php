<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}">
    <meta name="description" content="Page Description">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-black dark:text-white">
    <div class="grid min-h-screen w-full overflow-hidden lg:grid-cols-[280px_1fr]">
        <div class="hidden border-r dark:border-r-gray-800 bg-gray-100/40 dark:bg-[#090909] lg:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div class="flex h-[60px] items-center border-b px-6 dark:border-b-gray-800">
                    <a class="flex items-center gap-2 font-semibold" href="/">
                        <x-application-logo class="h-6 w-6" />
                        <span>Payment App</span>
                    </a>
                </div>
                <div class="flex-1 overflow-auto py-2">
                    <nav class="grid items-start px-4 text-sm font-medium gap-2">
                        <a class="flex items-center gap-3 rounded-md px-3 py-2 transition-colors {{ request()->is('/') ? 'bg-black text-white dark:bg-white dark:text-black hover:bg-black/90' : 'text-gray-900 dark:text-gray-50 hover:bg-gray-200 dark:hover:bg-gray-900' }}"
                            href="/" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                            Dashboard
                        </a>
                        <a class="flex items-center gap-3 rounded-md px-3 py-2 transition-colors {{ request()->is('profile') ? 'bg-black text-white dark:bg-white dark:text-black hover:bg-black/90' : 'text-gray-900 dark:text-gray-50 hover:bg-gray-200 dark:hover:bg-gray-900' }}"
                            href="/profile" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Profile
                        </a>
                        <a class="flex items-center gap-3 rounded-md px-3 py-2 transition-colors {{ request()->is('features') ? 'bg-black text-white dark:bg-white dark:text-black hover:bg-black/90' : 'text-gray-900 dark:text-gray-50 hover:bg-gray-200 dark:hover:bg-gray-900' }}"
                            href="/features" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />

                            </svg>
                            Features
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <header
                class="flex h-14 lg:h-[60px] items-center gap-4 border-b dark:border-b-gray-800 bg-gray-100/40 dark:bg-[#090909] px-6">
                <a class="lg:hidden" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-6 w-6">
                        <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                        <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                        <path d="M18 12a2 2 0 0 0 0 4h4v-4Z"></path>
                    </svg>
                    <span class="sr-only">Home</span></a>
                <div class="w-full flex-1">
                    <form class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500 dark:text-gray-400">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        <x-text-input class="pl-8 md:w-2/3 lg:w-1/3" placeholder="Search for something" type="search"
                            name="search" />
                    </form>
                </div>
                <div class="flex items-center gap-4">
                    <livewire:layout.avatar />
                </div>
            </header>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
