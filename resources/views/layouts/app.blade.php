<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Panel') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/svg+xml"
        href="https://raw.githubusercontent.com/devicons/devicon/v2.17.0/icons/akka/akka-original.svg">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{ mobileOpen: false }" class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <div class="flex flex-1 w-full">
            <!-- Sidebar -->
            <div class="hidden md:flex md:w-64 md:flex-col">
                <div class="flex flex-col flex-grow pt-5 bg-white overflow-y-auto border-r border-gray-200">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <h1 class="text-2xl font-bold text-gray-900">
                            <i class="fas fa-cogs text-blue-600 mr-2"></i>
                            Admin Panel
                        </h1>
                    </div>
                    <div class="mt-5 flex-grow flex flex-col">
                        <nav class="flex-1 px-2 pb-4 space-y-1">
                            <a href="{{ route('admin.dashboard') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <i class="fas fa-tachometer-alt mr-3 flex-shrink-0"></i>
                                Dashboard
                            </a>

                            <a href="{{ route('admin.quotes.index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.quotes.*') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <i class="fas fa-quote-left mr-3 flex-shrink-0"></i>
                                Motivational Quotes
                            </a>

                            {{-- <a href="{{ route('admin.horoscopes.index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.horoscopes.*') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <i class="fas fa-star mr-3 flex-shrink-0"></i>
                                Horoscopes
                            </a> --}}

                            {{-- <a href="{{ route('admin.voice-options.index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.voice-options.*') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <i class="fas fa-microphone mr-3 flex-shrink-0"></i>
                                Voice Options
                            </a> --}}

                            <a href="{{ route('admin.virtual-images.index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.virtual-images.*') ? 'bg-blue-100 text-blue-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <i class="fas fa-image mr-3 flex-shrink-0"></i>
                                Virtual Images
                            </a>

                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit"
                                    class="group flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-red-600 hover:bg-red-50 hover:text-red-800 focus:outline-none">
                                    <i class="fas fa-sign-out-alt mr-3 flex-shrink-0"></i>
                                    Log Out
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow items-center">
                    <!-- Mobile menu button (hamburger) -->
                    <button @click="mobileOpen = true" class="md:hidden px-4 focus:outline-none"
                        aria-label="Open sidebar">
                        <svg class="h-6 w-6 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="justify-end flex-1 px-8 flex md:justify-between">
                        <div class="hidden md:block ml-4 flex items-center md:ml-6">
                            <div class="ml-3 relative">
                                <div
                                    class="max-w-xs bg-white flex items-center text-lg rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <span class="ml-5 text-gray-700 font-bold">Welcome to Virtual Alarm!</span>
                                </div>
                            </div>
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            <div class="ml-3 relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 px-2 py-1"
                                    id="user-menu" aria-haspopup="true" :aria-expanded="open">
                                    <span
                                        class="inline-block h-8 w-8 rounded-full text-white flex items-center justify-center">
                                        @if(auth()->user()->avatar)
                                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar"
                                                class="h-7 w-7 rounded-full object-cover">
                                        @else
                                            <div
                                                class="h-7 w-7 rounded-full bg-gray-200 flex items-center justify-center text-xl text-gray-500">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </span>
                                    <span class="ml-2 text-gray-700">{{ auth()->user()->name ?? 'User' }}</span>
                                    <svg class="ml-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" x-cloak x-transition
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <a href="{{ route('admin.profile.show') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                        <a href="{{ route('admin.profile.edit') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit
                                            Profile</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log
                                                Out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page content -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            @if(session('success'))
                                <div x-data="{ open: true }" x-show="open" x-cloak x-transition
                                    class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-start"
                                    role="alert">
                                    <div class="flex-1">
                                        <span class="block sm:inline">{{ session('success') }}</span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <button @click="open = false" type="button"
                                            class="inline-flex items-center justify-center p-1 rounded-md text-green-700 hover:text-green-900 focus:outline-none"
                                            aria-label="Close">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <button @click="open = false" type="button"
                                        class="inline-flex items-center justify-center p-1 rounded-md text-green-700 hover:text-green-900 focus:outline-none"
                                        aria-label="Close">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endif

                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Mobile menu sidebar -->
        <div class="md:hidden">
            <div class="fixed inset-0 z-40 flex" x-show="mobileOpen" style="display: none;" x-cloak>
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="mobileOpen = false"></div>
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                    {{-- <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button"
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white bg-blue-600"
                            @click="$root.mobileOpen = false">
                            <i class="fas fa-times text-white"></i>
                        </button>
                    </div> --}}
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex-shrink-0 flex items-center px-4">
                            <h1 class="text-xl font-bold text-gray-900">Admin Panel</h1>
                        </div>
                        <nav class="mt-5 px-2 space-y-1">
                            <a href="{{ route('admin.dashboard') }}"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-tachometer-alt mr-4 flex-shrink-0"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.quotes.index') }}"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-quote-left mr-4 flex-shrink-0"></i>
                                Motivational Quotes
                            </a>
                            <a href="{{ route('admin.horoscopes.index') }}"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-star mr-4 flex-shrink-0"></i>
                                Horoscopes
                            </a>
                            <a href="{{ route('admin.voice-options.index') }}"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-microphone mr-4 flex-shrink-0"></i>
                                Voice Options
                            </a>
                            <a href="{{ route('admin.virtual-images.index') }}"
                                class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                <i class="fas fa-image mr-4 flex-shrink-0"></i>
                                Virtual Images
                            </a>
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit"
                                    class="group flex items-center w-full px-2 py-2 text-sm font-medium rounded-md text-red-600 hover:bg-red-50 hover:text-red-800 focus:outline-none">
                                    <i class="fas fa-sign-out-alt mr-3 flex-shrink-0"></i>
                                    Log Out
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @stack('scripts')
</body>

</html>