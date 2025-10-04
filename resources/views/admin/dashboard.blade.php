@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Dashboard
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Welcome to your content management dashboard
            </p>
        </div>
    </div>

    <!-- Stats cards -->
    <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Quotes Stats -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-quote-left text-2xl text-blue-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Quotes
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['quotes_count'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="font-medium text-green-600">
                        {{ $stats['active_quotes'] }} active
                    </span>
                </div>
            </div>
        </div>

        {{-- <!-- Horoscopes Stats -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-star text-2xl text-purple-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Horoscopes
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['horoscopes_count'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="font-medium text-green-600">
                        {{ $stats['active_horoscopes'] }} active
                    </span>
                </div>
            </div>
        </div> --}}

        <!-- Voice Options Stats -->
        {{-- <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-microphone text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Voice Options
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['voice_options_count'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="font-medium text-green-600">
                        {{ $stats['active_voice_options'] }} active
                    </span>
                </div>
            </div>
        </div> --}}

        <!-- Virtual Images Stats -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-image text-2xl text-orange-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Virtual Images
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['virtual_images_count'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="font-medium text-green-600">
                        {{ $stats['active_virtual_images'] }} active
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick actions -->
    <div class="mt-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('admin.quotes.create') }}" 
               class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-lg shadow hover:shadow-md transition-shadow">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-blue-50 text-blue-700 ring-4 ring-white">
                        <i class="fas fa-plus text-xl"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Add Quote
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Create a new motivational quote
                    </p>
                </div>
            </a>

            {{-- <a href="{{ route('admin.horoscopes.create') }}" 
               class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-purple-500 rounded-lg shadow hover:shadow-md transition-shadow">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-purple-50 text-purple-700 ring-4 ring-white">
                        <i class="fas fa-plus text-xl"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Add Horoscope
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Create a new horoscope text
                    </p>
                </div>
            </a> --}}

            {{-- <a href="{{ route('admin.voice-options.create') }}" 
               class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-green-500 rounded-lg shadow hover:shadow-md transition-shadow">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-green-50 text-green-700 ring-4 ring-white">
                        <i class="fas fa-plus text-xl"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Add Voice Option
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Add a new voice configuration
                    </p>
                </div>
            </a> --}}

            <a href="{{ route('admin.virtual-images.create') }}" 
               class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-500 rounded-lg shadow hover:shadow-md transition-shadow">
                <div>
                    <span class="rounded-lg inline-flex p-3 bg-orange-50 text-orange-700 ring-4 ring-white">
                        <i class="fas fa-plus text-xl"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-medium">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        Add Virtual Image
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Upload a new virtual image
                    </p>
                </div>
            </a>
        </div>
    </div>

    {{-- <!-- Recent activity -->
    <div class="mt-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Activity</h3>
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                <li class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-quote-left text-blue-500"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                New quote added
                            </div>
                            <div class="text-sm text-gray-500">
                                "Success is not final, failure is not fatal: it is the courage to continue that counts."
                            </div>
                        </div>
                        <div class="ml-auto text-sm text-gray-500">
                            2 hours ago
                        </div>
                    </div>
                </li>
                <li class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-star text-purple-500"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                Horoscope updated
                            </div>
                            <div class="text-sm text-gray-500">
                                Aries horoscope for today
                            </div>
                        </div>
                        <div class="ml-auto text-sm text-gray-500">
                            4 hours ago
                        </div>
                    </div>
                </li>
                <li class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-microphone text-green-500"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                Voice option created
                            </div>
                            <div class="text-sm text-gray-500">
                                Female voice - English (US)
                            </div>
                        </div>
                        <div class="ml-auto text-sm text-gray-500">
                            6 hours ago
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div> --}}
</div>
@endsection
