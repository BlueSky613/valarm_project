@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" />
                        @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Avatar</label>
                        <input id="avatarInput" type="file" name="avatar" accept="image/*" class="mt-1 block w-full" />
                        @error('avatar') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        <div class="mt-2" id="avatarPreviewWrapper">
                            @if($user->avatar)
                                <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" class="h-20 w-20 rounded-full object-cover">
                            @else
                                <img id="avatarPreview" src="" alt="avatar" class="hidden h-20 w-20 rounded-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" />
                        @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" />
                        @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
                        <a href="{{ route('admin.profile.show') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function(){
        const input = document.getElementById('avatarInput');
        if (!input) return;
        const preview = document.getElementById('avatarPreview');
        const wrapper = document.getElementById('avatarPreviewWrapper');

        input.addEventListener('change', function(e){
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            const url = URL.createObjectURL(file);
            if (preview) {
                preview.src = url;
                preview.classList.remove('hidden');
            } else {
                const img = document.createElement('img');
                img.id = 'avatarPreview';
                img.src = url;
                img.className = 'h-20 w-20 rounded-full object-cover';
                wrapper.innerHTML = '';
                wrapper.appendChild(img);
            }
        });
    })();
</script>
@endpush
