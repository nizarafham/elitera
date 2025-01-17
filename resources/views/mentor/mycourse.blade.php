<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">My Courses</h1>
        <a href="{{ route('mentor.mycourse.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">
            Create New Course
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($courses as $course)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative">
            <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
            <!-- Status Badge -->
            <div class="absolute top-2 right-2">
                @switch($course->status)
                    @case('approved')
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Approved
                        </span>
                        @break
                    @case('rejected')
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Rejected
                        </span>
                        @break
                    @default
                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Pending
                        </span>
                @endswitch
            </div>
        </div>
        <div class="p-4">
            <h3 class="text-xl font-bold">{{ $course->name }}</h3>
            <p class="text-gray-600 mt-2">{{ Str::limit($course->description, 100) }}</p>
            <p class="text-lg font-semibold text-green-600 mt-2">
                Rp. {{ number_format($course->price, 2, ',', '.') }}
            </p>
            <div class="mt-4 flex justify-between">
                <a href="{{ route('mentor.mycourse.edit', $course) }}" 
                   class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600">
                    Edit
                </a>
                <form action="{{ route('mentor.mycourse.destroy', $course) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this course?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-black px-4 py-2 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

    <div class="mt-6">
        {{ $courses->links() }}
    </div>
</div>
</x-app-layout>