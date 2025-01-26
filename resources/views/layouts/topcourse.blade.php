<section class="blog" id="blog">
    <div class="section__container blog__container bg-gray-10">
        <p class="section__subheader">COURSES</p>
        <h2 class="section__header">TOP 3 Popular Course</h2>
        <div class="blog__grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses as $course)
            <div class="blog__card course-card bg-white shadow-md rounded-lg p-4">
                <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="rounded-t-lg w-full h-48 object-cover">
                <div>
                    <p class="text-gray-500 mt-1">Mentor: {{ $course->mentor->name }}</p>
                    <h4 class="text-xl font-bold mt-4">{{ $course->name }}</h4>
                    <p class="text-gray-600 mt-2">{{ $course->description }}</p>
                    <p class="text-lg font-semibold text-green-600 mt-2">Rp. {{ number_format($course->price, 2, ',', '.') }}</p>
                </div>
                <button class="bg-blue-500 hover:bg-[#ff9442] font-bold text-white py-2 px-4 rounded mt-4">
                    <a href="{{ route('courses.show', $course->id) }}">VIEW</a>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>