@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Profile</h2>

            <div class="flex items-start space-x-6">
                <div class="flex-shrink-0">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" class="h-28 w-28 rounded-full object-cover">
                    @else
                        <div class="h-28 w-28 rounded-full bg-gray-200 flex items-center justify-center text-2xl text-gray-500">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1 text-gray-900">{{ $user->name }}</div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 text-gray-900">{{ $user->email }}</div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('admin.profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
