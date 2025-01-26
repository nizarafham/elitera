<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
/>
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>

<link rel="stylesheet" href="\css\course.css" />

<div class="video-player">
    <iframe 
        id="current-video" 
        class="w-full h-80" 
        src="{{ 'https://www.youtube.com/embed/' . $firstVideo->getVideoIdFromUrl() }}?autoplay=1&rel=0"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe>
    <h1 id="video-title">{{ $firstVideo->title }}</h1>
    <p id="video-description">{{ $firstVideo->description }}</p>
</div>

<div class="course-info">
    <h2>{{ $course->name }}</h2>
    <p>{{ $course->description }}</p>
</div>

<div class="video-playlist">
    @foreach($course->videos as $index => $video)
        <div class="video-item {{ $index === 0 ? 'active' : 'locked' }}" 
            data-id="{{ $video->id }}"
            data-url="{{ $video->url }}"
            data-title="{{ $video->title }}"
            data-description="{{ $video->description }}">
            <h3>{{ $video->title }}</h3>
            <a href="{{ $video->material_url }}" class="download-btn" download>📄 Unduh Materi</a>
            @if($video->quiz)
            <div class="quiz-container">
                <h3>Kuis</h3>
                <p id="quiz-question">{{ $video->quiz->question }}</p>
                <input type="text" class="quiz-answer" placeholder="Ketik jawaban Anda di sini">
                <button class="quiz-btn">Kirim Jawaban</button>
                <p class="quiz-feedback"></p>
            </div>
            @else
              @foreach($quizData as $quiz)
                  <p>{{ $quiz['question'] }}</p>
              @endforeach
            @endif
        </div>
    @endforeach
</div>
