@extends('layouts.app')

@section('title', 'Edit Quote')

@section('content')
<div>
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Edit Quote
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Update the motivational quote
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.quotes.index') }}" 
               class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left -ml-1 mr-2 h-5 w-5"></i>
                Back to Quotes
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="mt-8">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.quotes.update', $quote) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Quote Details</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Update the quote content and metadata.
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-1 gap-6">
                                <div class="col-span-6">
                                    <label for="content" class="block text-sm font-medium text-gray-700">
                                        Quote Content <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <textarea id="content" name="content" rows="4" 
                                                  class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('content') border-red-300 @enderror"
                                                  placeholder="Enter the motivational quote...">{{ old('content', $quote->content) }}</textarea>
                                    </div>
                                    @error('content')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="author" class="block text-sm font-medium text-gray-700">
                                        Author
                                    </label>
                                    <input type="text" name="author" id="author" value="{{ old('author', $quote->author) }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('author') border-red-300 @enderror"
                                           placeholder="Quote author (optional)">
                                    @error('author')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category" class="block text-sm font-medium text-gray-700">
                                        Category
                                    </label>
                                    <input type="text" name="category" id="category" value="{{ old('category', $quote->category) }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('category') border-red-300 @enderror"
                                           placeholder="e.g., motivation, success, life">
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="scheduled_at" class="block text-sm font-medium text-gray-700">
                                        Schedule for
                                    </label>
                                    <input type="datetime-local" name="scheduled_at" id="scheduled_at" 
                                           value="{{ old('scheduled_at', $quote->scheduled_at ? $quote->scheduled_at->format('Y-m-d\TH:i') : '') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('scheduled_at') border-red-300 @enderror">
                                    <p class="mt-1 text-sm text-gray-500">Leave empty to publish immediately</p>
                                    @error('scheduled_at')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <div class="flex items-center">
                                        <input id="is_active" name="is_active" type="checkbox" value="1" 
                                               {{ old('is_active', $quote->is_active) ? 'checked' : '' }}
                                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                            Active (visible to users)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" 
                            onclick="window.location.href='{{ route('admin.quotes.index') }}'"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save -ml-1 mr-2 h-5 w-5"></i>
                        Update Quote
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
