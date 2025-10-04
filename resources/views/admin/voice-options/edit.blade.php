@extends('layouts.app')

@section('title', 'Edit Voice Option')

@section('content')
<div>
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Edit Voice Option
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Update the voice configuration
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('admin.voice-options.index') }}" 
               class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <i class="fas fa-arrow-left -ml-1 mr-2 h-5 w-5"></i>
                Back to Voice Options
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="mt-8">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.voice-options.update', $voiceOption) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Voice Configuration</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Update the voice settings and parameters.
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-1 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Voice Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $voiceOption->name) }}"
                                           class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-300 @enderror"
                                           placeholder="e.g., Female Voice - English">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="voice_id" class="block text-sm font-medium text-gray-700">
                                        Voice ID <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="voice_id" id="voice_id" value="{{ old('voice_id', $voiceOption->voice_id) }}"
                                           class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('voice_id') border-red-300 @enderror"
                                           placeholder="e.g., en-US-Wavenet-A">
                                    @error('voice_id')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="language" class="block text-sm font-medium text-gray-700">
                                        Language <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="language" id="language" value="{{ old('language', $voiceOption->language) }}"
                                           class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('language') border-red-300 @enderror"
                                           placeholder="e.g., en-US, es-ES, fr-FR">
                                    @error('language')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="gender" class="block text-sm font-medium text-gray-700">
                                        Gender
                                    </label>
                                    <select id="gender" name="gender" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('gender') border-red-300 @enderror">
                                        <option value="">Select gender</option>
                                        <option value="male" {{ old('gender', $voiceOption->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $voiceOption->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="neutral" {{ old('gender', $voiceOption->gender) == 'neutral' ? 'selected' : '' }}>Neutral</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="speed" class="block text-sm font-medium text-gray-700">
                                        Speed <span class="text-red-500">*</span>
                                    </label>
                                    <select id="speed" name="speed" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('speed') border-red-300 @enderror">
                                        <option value="1" {{ old('speed', $voiceOption->speed) == 1 ? 'selected' : '' }}>Very Slow (1)</option>
                                        <option value="2" {{ old('speed', $voiceOption->speed) == 2 ? 'selected' : '' }}>Slow (2)</option>
                                        <option value="3" {{ old('speed', $voiceOption->speed) == 3 ? 'selected' : '' }}>Normal (3)</option>
                                        <option value="4" {{ old('speed', $voiceOption->speed) == 4 ? 'selected' : '' }}>Fast (4)</option>
                                        <option value="5" {{ old('speed', $voiceOption->speed) == 5 ? 'selected' : '' }}>Very Fast (5)</option>
                                    </select>
                                    @error('speed')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="pitch" class="block text-sm font-medium text-gray-700">
                                        Pitch <span class="text-red-500">*</span>
                                    </label>
                                    <select id="pitch" name="pitch" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('pitch') border-red-300 @enderror">
                                        <option value="1" {{ old('pitch', $voiceOption->pitch) == 1 ? 'selected' : '' }}>Very Low (1)</option>
                                        <option value="2" {{ old('pitch', $voiceOption->pitch) == 2 ? 'selected' : '' }}>Low (2)</option>
                                        <option value="3" {{ old('pitch', $voiceOption->pitch) == 3 ? 'selected' : '' }}>Normal (3)</option>
                                        <option value="4" {{ old('pitch', $voiceOption->pitch) == 4 ? 'selected' : '' }}>High (4)</option>
                                        <option value="5" {{ old('pitch', $voiceOption->pitch) == 5 ? 'selected' : '' }}>Very High (5)</option>
                                    </select>
                                    @error('pitch')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">
                                        Description
                                    </label>
                                    <textarea id="description" name="description" rows="3" 
                                              class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-300 @enderror"
                                              placeholder="Optional description of this voice option...">{{ old('description', $voiceOption->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <div class="flex items-center">
                                        <input id="is_active" name="is_active" type="checkbox" value="1" 
                                               {{ old('is_active', $voiceOption->is_active) ? 'checked' : '' }}
                                               class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
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
                            onclick="window.location.href='{{ route('admin.voice-options.index') }}'"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save -ml-1 mr-2 h-5 w-5"></i>
                        Update Voice Option
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
