@section('title', 'Course: ')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto px-4 py-8" style="margin-top:50px">
    <div class="flex items-center">
        <!-- Course Image -->
        <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="rounded-t-lg w-1/2 h-auto object-cover">

        <!-- Course Details (Text) -->
        <div class="ml-6 w-1/2 ">
            <!-- Course Title -->
            <h3 class="text-xl font-bold">{{ $course->name }}</h3>

            <!-- Course Description -->
            <p class="text-gray-600 mt-2">{{ $course->sub_description }}</p>

            <!-- Course Price -->
            <p class="text-lg font-semibold text-green-600 mt-2">Rp. {{ number_format($course->price, 2, ',', '.') }}</p>

            <!-- Mentor Name -->
            <p class="text-gray-500 mt-1">Mentor: {{ $course->mentor->name }}</p>
            <p class="text-gray-500 mt-1">Email: {{ $course->mentor->email }}</p>

            <!-- Join Course (buy) -->
            <div class="mt-6">
            @if (auth()->user()->courses->contains($course->id))
                <p class="text-green-600 mb-8">You already own this course?</p>
                <a href="{{ route('courses.watch', $course->id) }}" class="watch-btn mt-10 px-6 py-3 text-white bg-blue-500 hover:bg-[#ff9442] font-bold rounded-lg">
                    Watch Course
                </a>
            @else
                <form action="{{ route('transaction.create', $course->id) }}" method="POST">
                    @csrf
                    <button class="watch-btn mt-10 px-6 py-2 text-white bg-blue-500 hover:bg-orange-600 font-bold rounded-lg">
                        Join
                    </button>
                </form>
            @endif

            </div>

            <!-- Back to Course List -->
            <a href="{{ url('/courses') }}" class="inline-block mt-6 text-blue-500 hover:underline">Back to Course List</a>
        </div>
    </div>
</div>
