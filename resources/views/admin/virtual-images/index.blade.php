@extends('layouts.app')

@section('title', 'Virtual Images')

@section('content')
<div>
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Virtual Images
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Manage your virtual image collection
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.virtual-images.create') }}" 
               class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                <i class="fas fa-plus -ml-1 mr-2 h-5 w-5"></i>
                Add Virtual Image
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" 
                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <i class="fas fa-search -ml-1 mr-2 h-4 w-4"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Virtual images grid -->
    <div class="mt-8">
        @if($virtualImages->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($virtualImages as $virtualImage)
                    <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow">
                        <div class="aspect-w-16 aspect-h-9">
                            <video class="w-full h-48 object-contain" 
                                      src="http://127.0.0.1:8000/storage/{{ $virtualImage->image_path }}" 
                                      controls 
                                      type="video/mp4">
                                  Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900 truncate">
                                    {{ $virtualImage->name }}
                                </h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $virtualImage->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $virtualImage->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            @if($virtualImage->category)
                                <p class="mt-1 text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                        {{ ucfirst($virtualImage->category) }}
                                    </span>
                                </p>
                            @endif
                            @if($virtualImage->description)
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit($virtualImage->description, 100) }}
                                </p>
                            @endif
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs text-gray-500">
                                    {{ $virtualImage->created_at->format('M j, Y') }}
                                </span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.virtual-images.edit', $virtualImage) }}" 
                                       class="text-orange-600 hover:text-orange-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.virtual-images.destroy', $virtualImage) }}" method="POST" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this virtual image?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-image text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No virtual images found</h3>
                <p class="text-gray-500 mb-4">Get started by uploading your first virtual image.</p>
                <a href="{{ route('admin.virtual-images.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <i class="fas fa-plus -ml-1 mr-2 h-5 w-5"></i>
                    Add Virtual Image
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($virtualImages->hasPages())
        <div class="mt-6">
            {{ $virtualImages->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
