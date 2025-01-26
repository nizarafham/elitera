<script src="https://cdn.tailwindcss.com"></script>
<x-app-layout>
<div class="py-8 px-4 md:px-12 mx-auto max-w-7xl">
    <form action="{{ route('mentor.mycourse.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Course Information Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Course Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Course Name -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Intro</label>
                    <textarea name="description" id="description" rows="1" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sub Description -->
                <div class="col-span-2">
                    <label for="sub_description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="sub_description" id="sub_description" rows="2" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('sub_description') }}</textarea>
                    @error('sub_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="0.01"
                            class="w-full pl-8 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Level -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" id="level" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>Beginner</option>
                        <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>Intermediate</option>
                        <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Course Image -->
                <div class="col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Course Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Material Information Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Course Material</h2>
            <div class="space-y-6">
                <!-- Material Title -->
                <div>
                    <label for="material_title" class="block text-sm font-medium text-gray-700 mb-1">Material Title</label>
                    <input type="text" name="material_title" id="material_title" value="{{ old('material_title') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('material_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Material Description -->
                <div>
                    <label for="material_description" class="block text-sm font-medium text-gray-700 mb-1">Material Description</label>
                    <textarea name="material_description" id="material_description" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('material_description') }}</textarea>
                    @error('material_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Material File -->
                <div>
                    <label for="material_file" class="block text-sm font-medium text-gray-700 mb-1">Material File (PDF)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="material_file" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="material_file" name="material_file" type="file" class="sr-only" accept="application/pdf">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, Max 10MB</p>
                        </div>
                    </div>
                    @error('material_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Quiz Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">Course Videos</h2>
            <button type="button" onclick="addVideoField()" 
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Add Video
            </button>
        </div>
        
        <div id="video-container" class="space-y-6">
            <div class="video-entry p-4 border border-gray-200 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video Title</label>
                        <input type="text" name="video_titles[]" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                        <input type="url" name="video_urls[]" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div id="quiz-container-0" class="mt-4 space-y-4">
                    <h3 class="text-lg font-bold text-gray-700">Quizzes for this Video</h3>
                    <div class="quiz-entry p-3 border rounded-md">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                        <input type="text" name="quiz_questions[0][]" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        <label class="block text-sm font-medium text-gray-700 mt-2 mb-1">Options</label>
                        <textarea name="quiz_options[0][]" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>

                        <label class="block text-sm font-medium text-gray-700 mt-2 mb-1">Correct Answer</label>
                        <input type="text" name="quiz_answers[0][]" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" id="submit-btn" class="btn btn-primary mt-6">Save</button>
        </div>
    </form>
</div>

<script>
    function addVideoField() {
        const container = document.getElementById('video-container');
        const videoIndex = container.children.length; // Hitung jumlah video saat ini
        const videoEntry = document.createElement('div');
        videoEntry.className = 'video-entry p-4 border border-gray-200 rounded-lg mb-4';
        videoEntry.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video Title</label>
                    <input type="text" name="video_titles[]" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                    <input type="url" name="video_urls[]" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            <div id="quiz-container-${videoIndex}" class="mt-4 space-y-4">
                <h3 class="text-lg font-bold text-gray-700">Quizzes for this Video</h3>
                <div class="quiz-entry p-3 border rounded-md">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                    <input type="text" name="quiz_questions[${videoIndex}][]" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    <label class="block text-sm font-medium text-gray-700 mt-2 mb-1">Options</label>
                    <textarea name="quiz_options[${videoIndex}][]" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-2 mb-1">Correct Answer</label>
                    <input type="text" name="quiz_answers[${videoIndex}][]" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" 
                class="mt-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                Remove Video
            </button>
        `;
        container.appendChild(videoEntry);
    }
</script>
</x-app-layout>
