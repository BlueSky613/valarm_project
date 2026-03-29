@extends('layouts.app')

@section('title', 'App wallet users')

@section('content')
<div>
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                App wallet users
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Wallet registrations from the mobile app
            </p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white overflow-hidden shadow rounded-lg sm:col-span-2 lg:col-span-1">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-wallet text-2xl text-teal-600"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                App wallet users
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['wallet_users_count'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm space-y-1">
                    <div>
                        <span class="font-medium text-teal-600">{{ $stats['wallet_users_premium_count'] }} premium (Pro)</span>
                    </div>
                    <div>
                        <a href="{{ route('admin.wallet-users.index') }}" class="font-medium text-teal-600 hover:text-teal-800">
                            View registrations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
