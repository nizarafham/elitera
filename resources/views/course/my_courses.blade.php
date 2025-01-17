<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">My Courses</h1>

        @if($courses->isEmpty())
            <p class="text-gray-600">You haven't purchased any courses yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="rounded-t-lg w-full h-48 object-cover">
                        <h3 class="text-xl font-bold mt-4">{{ $course->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $course->description }}</p>
                        <p class="text-lg font-semibold text-green-600 mt-2">Rp. {{ number_format($course->price, 2, ',', '.') }}</p>
                        <p class="text-gray-500 mt-1">Mentor: {{ $course->mentor->name }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
