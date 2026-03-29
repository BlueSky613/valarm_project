@extends('layouts.app')

@section('title', 'Edit Virtual Image')

@section('content')
<div>
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Edit Virtual Image
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Update the virtual image details
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.virtual-images.index') }}" 
               class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                <i class="fas fa-arrow-left -ml-1 mr-2 h-5 w-5"></i>
                Back to Virtual Images
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="mt-8">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.virtual-images.update', $virtualImage) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Image Details</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Update the virtual image configuration.
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Current image preview -->
                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Current Image
                                    </label>
                                    <div class="flex justify-center">
                                        <img src="http://127.0.0.1:8000/storage/{{ $virtualImage->thumbnail }}" 
                                             alt="{{ $virtualImage->name }}"
                                             class="max-w-xs rounded-lg shadow-sm">
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Image Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $virtualImage->name) }}"
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-300 @enderror"
                                           placeholder="e.g., Virtual Assistant Avatar">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="image" class="block text-sm font-medium text-gray-700">
                                        Replace Image
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                        <div class="space-y-1 text-center">
                                            <span id="upload-icon">
                                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                            </span>
                                            <div id="video-preview" class="hidden">
                                                <video id="preview-video" class="mx-auto rounded-lg shadow-sm max-w-xs" controls></video>
                                            </div>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500">
                                                        <span>Upload video</span>
                                                        <input id="image" name="image" type="file" accept="image/*,video/mp4,video/webm,video/ogg" 
                                                           class="sr-only @error('image') border-red-300 @enderror"
                                                           onchange="previewImage(this)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            {{-- <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF, SVG up to 2MB
                                            </p> --}}
                                        </div>
                                    </div>
                                    @error('image')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    
                                    <!-- New image preview -->
                                    <div id="image-preview" class="mt-4 hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            New Image Preview
                                        </label>
                                        <img id="preview-img" class="max-w-xs mx-auto rounded-lg shadow-sm" alt="Preview">
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category" class="block text-sm font-medium text-gray-700">
                                        Category
                                    </label>
                                    <input type="text" name="category" id="category" value="{{ old('category', $virtualImage->category) }}"
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('category') border-red-300 @enderror"
                                           placeholder="e.g., avatar, background, icon">
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">
                                        Description
                                    </label>
                                    <textarea id="description" name="description" rows="3" 
                                              class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-300 @enderror"
                                              placeholder="Optional description of this virtual image...">{{ old('description', $virtualImage->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <div class="flex items-center">
                                        <input id="is_active" name="is_active" type="checkbox" value="1" 
                                               {{ old('is_active', $virtualImage->is_active) ? 'checked' : '' }}
                                               class="focus:ring-orange-500 h-4 w-4 text-orange-600 border-gray-300 rounded">
                                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                            Active (available for use)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" 
                            onclick="window.location.href='{{ route('admin.virtual-images.index') }}'"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        <i class="fas fa-save -ml-1 mr-2 h-5 w-5"></i>
                        Update Virtual Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        // const imagePreview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const videoPreview = document.getElementById('video-preview');
        const previewVideo = document.getElementById('preview-video');
        const uploadIcon = document.getElementById('upload-icon');

        // Hide all previews first
        // imagePreview.classList.add('hidden');
        videoPreview.classList.add('hidden');
        uploadIcon.classList.add('hidden');

        console.log('File type:', file.type);

        if (file.type.startsWith('video/')) {
            // Show video preview

            console.log('File is a video');

            const url = URL.createObjectURL(file);

            console.log('Video URL:', url);

            previewVideo.src = url;
            videoPreview.classList.remove('hidden');
        } else if (file.type.startsWith('image/')) {
            // Show image preview
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            // Show upload icon if not image/video
            uploadIcon.classList.remove('hidden');
        }
    }
}
</script>
@endsection
