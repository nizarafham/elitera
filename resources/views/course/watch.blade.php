<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="\css\course.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
@include('layouts.navigation')
    <div class="video-container">
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

        <div class="video-details">
            <div class="course-info">
                <h2>{{ $course->name }}</h2>
                <p>{{ $course->description }}</p>
                <div class="material">
                    @foreach ($materials as $material)
                    <h5>Materi:</h5>
                    <!-- <p>{{ $material->desc }}</p> -->
                    <a href="{{ asset($material->file_path) }}" target="_blank">Download PDF</a>
                    @endforeach
                </div>
            </div>

            <div class="video-playlist">
                @foreach($course->videos as $index => $video)
                    <div class="video-item {{ $index === 0 ? 'active' : 'locked' }}" 
                        data-id="{{ $video->id }}"
                        data-url="{{ $video->url }}"
                        data-title="{{ $video->title }}"
                        data-description="{{ $video->description }}">
                        <h3>{{ $video->title }}</h3>

                        @if($video->quiz)
                            <div class="quiz-container color-black">
                                <h3>Kuis</h3>
                                <p id="quiz-question">{{ $video->quiz->question ?? 'No question available' }}</p>
                                <input type="text" class="quiz-answer" placeholder="Ketik jawaban Anda di sini">
                                <button class="quiz-btn">Kirim Jawaban</button>
                                <p class="quiz-feedback"></p>
                            </div>
                        @else
                            <p>No quiz available for this video</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="additional-quiz">
                @foreach($quizData as $quiz)
                    <div class="quiz-item">
                        <h3>{{ $quiz->question }}</h3>
                        <input type="text" class="quiz-answer" placeholder="Ketik jawaban Anda di sini">
                        <button class="quiz-btn">Kirim Jawaban</button>
                        <p class="quiz-feedback"></p>
                    </div>
                @endforeach
                <button id="certificate-button" class="btn btn-primary">Ajukan Sertifikat</button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- <script src="/js/course.js"></script> -->
    <script>  
    document.addEventListener('DOMContentLoaded', function () {
    const quizButtons = document.querySelectorAll('.quiz-btn');
    const videoItems = document.querySelectorAll('.video-item');
    const videoPlayer = document.querySelector('#video-player');
    const videoIframe = document.querySelector('#current-video'); 
    const videoTitle = document.querySelector('#video-title');
    const certificateButton = document.querySelector('#certificate-button'); 

    certificateButton.style.display = 'none';
    certificateButton.disabled = true;

    videoItems.forEach(videoItem => {
        const isLocked = videoItem.classList.contains('locked');
        const quizContainer = videoItem.querySelector('.quiz-container');
        const answerInput = quizContainer.querySelector('.quiz-answer');
        const quizButton = quizContainer.querySelector('.quiz-btn');

        // Kunci input dan tombol jika item terkunci
        if (isLocked) {
            answerInput.disabled = true;
            quizButton.disabled = true;
        } else {
            answerInput.disabled = false;
            quizButton.disabled = false;
        }

        videoItem.addEventListener('click', function () {
            if (!videoItem.classList.contains('locked')) {
                const videoId = videoItem.getAttribute('data-id');
                
                fetch(`/get-video-url/${videoId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Ambil URL YouTube dari data dan konversi ke format embed
                        const videoUrl = convertToEmbedUrl(data.video_url); // Fungsi untuk konversi URL
                        
                        // Perbarui iframe dengan URL video embed
                        if (videoIframe) {
                            videoIframe.src = videoUrl; // Ubah URL video pada iframe
                        }

                        console.log(`Video diganti ke: ${data.video_title} dengan URL: ${videoUrl}`);
                    } else {
                        console.error('Gagal mendapatkan detail video:', data.message || 'Tidak ada pesan kesalahan.');
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat mengambil detail video:', error);
                });
            } else {
                console.warn('Video ini terkunci dan tidak dapat diakses.');
            }
        });
    });

    quizButtons.forEach(button => {
        button.addEventListener('click', function () {
            const quizContainer = button.closest('.quiz-container');
            const videoItem = quizContainer.closest('.video-item');
            const answerInput = quizContainer.querySelector('.quiz-answer');
            const feedbackParagraph = quizContainer.querySelector('.quiz-feedback');
            const videoId = videoItem.getAttribute('data-id');

            const answer = answerInput.value.trim();

            fetch('/submit-answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    video_id: videoId,
                    answer: answer
                })
            })
                .then(response => response.json())
                .then(data => {
                    feedbackParagraph.textContent = data.message;

                    if (data.status === 'success') {
                        const nextVideoItem = videoItem.nextElementSibling;
                        if (nextVideoItem) {
                            nextVideoItem.classList.remove('locked');
                            nextVideoItem.classList.add('active');

                            const nextQuizContainer = nextVideoItem.querySelector('.quiz-container');
                            const nextAnswerInput = nextQuizContainer.querySelector('.quiz-answer');
                            const nextQuizButton = nextQuizContainer.querySelector('.quiz-btn');
                            nextAnswerInput.disabled = false;
                            nextQuizButton.disabled = false;
                        } else {
                            certificateButton.style.display = 'block';
                            certificateButton.disabled = false; 
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    feedbackParagraph.textContent = 'Terjadi kesalahan saat memeriksa jawaban';
                });
        });
    });

    certificateButton.addEventListener('click', function () {
        fetch('/submit-certificate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ request: 'certificate' })
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message || 'Sertifikat berhasil diajukan!');
                certificateButton.disabled = true; // Cegah pengajuan ulang
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengajukan sertifikat.');
            });
    });
    function convertToEmbedUrl(url) {
        const youtubeRegex = /^https:\/\/(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/;
        const match = url.match(youtubeRegex);
        if (match) {
            return `https://www.youtube.com/embed/${match[1]}`;
        } else {
            console.error('URL YouTube tidak valid:', url);
            return '';
        }
    }
});

</script>
@include('layouts.footer')