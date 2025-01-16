<!DOCTYPE html>  
<html lang="en">  
  <head>  
    <meta charset="UTF-8" />  
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
  
    <!-- <link rel="stylesheet" href="/course/css/video-page.css" />   -->
    <title>E-Litera</title>  
  </head>
  <x-app-layout>  

  <div class="flex max-w-6xl mx-auto my-10 bg-white border border-gray-300 rounded-lg overflow-hidden">  
      <div class="flex-2 p-5">  
        <iframe   
          id="current-video"  
          class="w-full h-80"  
          src="https://www.youtube.com/embed/wriGST3vp5M?autoplay=1&rel=0"   
          title="YouTube video player"   
          frameborder="0"   
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"   
          allowfullscreen>  
        </iframe>  
        <h1 id="video-title" class="my-5 text-2xl text-gray-800 font-bold">Episode 01 - Apa itu HTML</h1>  
        <p id="video-description" class="text-gray-600">Pada video ini, Anda akan belajar dasar-dasar HTML, elemen paling penting dalam pengembangan web!</p>  
      </div>  
  
      <div class="flex-1 flex flex-col bg-white border-l border-gray-300 overflow-y-auto max-h-[calc(100vh-40px)] p-5">  
        <div class="course-info mb-5">  
          <h2 class="text-xl text-gray-800">Belajar Web - HTML & CSS [Dasar]</h2>  
          <p class="text-gray-600">Temukan cara membangun situs web modern dengan HTML dan CSS. Playlist ini mencakup dasar-dasar hingga teknik lanjutan, cocok untuk pemula.</p>  
        </div>  
  
        <div class="video-playlist flex flex-col">  
          <!-- Video 1 -->  
          <div class="video-item active p-4 border-b border-gray-200 cursor-pointer transition duration-300 hover:bg-gray-200" data-id="1" data-url="https://www.youtube.com/embed/wriGST3vp5M" data-title="Episode 01 - Apa itu HTML" data-description="Pada video ini, Anda akan belajar dasar-dasar HTML, elemen paling penting dalam pengembangan web!">  
            <h3 class="text-lg">Episode 01 - Apa itu HTML</h3>  
            <a href="/document/html.pdf" class="download-btn text-blue-600 underline mt-2" download>📄 Unduh Materi</a>  
            <div class="quiz-container mt-3 p-3 border border-gray-300 rounded bg-gray-100">  
              <h3 class="text-gray-800">Kuis</h3>  
              <p id="quiz-question-1">Apa itu HTML?</p>  
              <input type="text" class="quiz-answer w-full p-2 border border-gray-300 rounded mb-2" placeholder="Ketik jawaban Anda di sini">  
              <button class="quiz-btn bg-blue-600 text-white py-2 px-4 rounded">Kirim Jawaban</button>  
              <p class="quiz-feedback"></p>  
            </div>  
          </div>  
  
          <!-- Video 2 -->  
          <div class="video-item locked p-4 border-b border-gray-200 cursor-not-allowed opacity-50" data-id="2" data-url="https://www.youtube.com/embed/GAd6FTsGSY8" data-title="Episode 02 - Instalasi dan Persiapan" data-description="Pelajari cara menginstal alat dan mempersiapkan lingkungan untuk pengembangan web.">  
            <h3 class="text-lg">Episode 02 - Instalasi dan Persiapan</h3>  
            <a href="/documents/html.pdf" class="download-btn text-blue-600 underline mt-2" download>📄 Unduh Materi</a>  
            <div class="quiz-container mt-3 p-3 border border-gray-300 rounded bg-gray-100">  
              <h3 class="text-gray-800">Kuis</h3>  
              <p id="quiz-question-2">Apa saja alat yang diperlukan untuk memulai pengembangan web?</p>  
              <input type="text" class="quiz-answer w-full p-2 border border-gray-300 rounded mb-2" placeholder="Ketik jawaban Anda di sini">  
              <button class="quiz-btn bg-blue-600 text-white py-2 px-4 rounded">Kirim Jawaban</button>  
              <p class="quiz-feedback"></p>  
            </div>  
          </div>  
  
          <!-- Video 3 -->  
          <div class="video-item locked p-4 border-b border-gray-200 cursor-not-allowed opacity-50" data-id="3" data-url="https://www.youtube.com/embed/TM12RA6cmOQ" data-title="Episode 03 - Struktur HTML" data-description="Memahami struktur dasar HTML dan cara mengatur dokumen dengan benar.">  
            <h3 class="text-lg">Episode 03 - Struktur HTML</h3>  
            <a href="/document/html.pdf" class="download-btn text-blue-600 underline mt-2" download>📄 Unduh Materi</a>  
            <div class="quiz-container mt-3 p-3 border border-gray-300 rounded bg-gray-100">  
              <h3 class="text-gray-800">Kuis</h3>  
              <p id="quiz-question-3">Struktur HTML apa saja?</p>  
              <input type="text" class="quiz-answer w-full p-2 border border-gray-300 rounded mb-2" placeholder="Ketik jawaban Anda di sini">  
              <button class="quiz-btn bg-blue-600 text-white py-2 px-4 rounded">Kirim Jawaban</button>  
              <p class="quiz-feedback"></p>  
            </div>  
          </div>  
  
          <!-- Video 4 -->  
          <div class="video-item locked p-4 border-b border-gray-200 cursor-not-allowed opacity-50" data-id="4" data-url="https://www.youtube.com/embed/bd03BfqfOSk" data-title="Episode 04 - Heading dan Paragraph" data-description="Pelajari tentang elemen Heading dan Paragraph dalam HTML.">  
            <h3 class="text-lg">Episode 04 - Heading dan Paragraph</h3>  
            <a href="/documents/episode1.pdf" class="download-btn text-blue-600 underline mt-2" download>📄 Unduh Materi</a>  
            <div class="quiz-container mt-3 p-3 border border-gray-300 rounded bg-gray-100">  
              <h3 class="text-gray-800">Kuis</h3>  
              <p id="quiz-question-4">Apa singkatan dari HTML?</p>  
              <input type="text" class="quiz-answer w-full p-2 border border-gray-300 rounded mb-2" placeholder="Ketik jawaban Anda di sini">  
              <button class="quiz-btn bg-blue-600 text-white py-2 px-4 rounded">Kirim Jawaban</button>  
              <p class="quiz-feedback"></p>  
            </div>  
          </div>  
  
          <!-- Sertifikat -->  
          <div id="certificate-container" class="certificate-container mt-5 p-3 border border-gray-300 rounded bg-gray-100">  
            <h3 class="text-gray-800">Sertifikat</h3>  
            <p>Selamat! Anda telah menyelesaikan semua materi. Unduh sertifikat Anda di bawah ini:</p>  
            <button id="download-certificate" class="certificate-btn bg-green-600 text-white py-2 px-4 rounded" disabled>Unduh Sertifikat</button>  
          </div>  
        </div>  
      </div>  
    </div>    
  
    <!-- <script src="https://unpkg.com/scrollreveal"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>   -->
    <script src="{{ asset('js/course.js') }}" defer></script>   
    </x-app-layout>
  </body>  
</html>  
