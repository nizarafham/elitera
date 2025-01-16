<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
</head>
<body>
<section class="blog" id="blog">
    <div class="section__container blog__container">
        <h2 class="section__header">Explore Our Latest Courses</h2>
        <div class="pb-3">
            <form class="d-flex" action="{{ url('courses') }}" method="get">
                <input class="form-control me-1" type="search" name="value" value="{{ Request::get('value') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>
        <div class="blog__grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses as $course)
            <div class="blog__card bg-white shadow-md rounded-lg p-4">
                <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="rounded-t-lg w-full h-48 object-cover">
                <h3 class="text-xl font-bold mt-4">{{ $course->name }}</h3>
                <p class="text-gray-600 mt-2">{{ $course->description }}</p>
                <p class="text-lg font-semibold text-green-600 mt-2">Rp. {{ number_format($course->price, 2, ',', '.') }}</p>
                <p class="text-gray-500 mt-1">Mentor: {{ $course->mentor->name }}</p>
                <button class="bg-[#ff9442] text-white py-2 px-4 rounded mt-4">
                    <a href="{{ route('courses.show', $course->id) }}">JOIN</a>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>
</body>
</html>