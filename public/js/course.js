document.addEventListener("DOMContentLoaded", () => {  
    console.log("DOM fully loaded and parsed"); // Debugging  
  
    // Ambil elemen-elemen penting  
    const videoItems = document.querySelectorAll(".video-item");  
    const currentVideo = document.getElementById("current-video");  
    const videoTitle = document.getElementById("video-title");  
    const videoDescription = document.getElementById("video-description");  
    const certificateButton = document.getElementById("download-certificate");  
  
    // Fungsi untuk memperbarui video yang sedang diputar  
    function updateVideo(item) {  
        const videoUrl = item.getAttribute("data-url");  
        const title = item.getAttribute("data-title");  
        const description = item.getAttribute("data-description");  
  
        console.log("Updating video to:", title); // Debugging  
        currentVideo.src = `${videoUrl}?autoplay=1&rel=0`;  
        videoTitle.textContent = title;  
        videoDescription.textContent = description;  
        document.querySelector(".video-item.active")?.classList.remove("active");  
        item.classList.add("active");  
    }  
  
    // Fungsi untuk membuka akses ke video berikutnya  
    function unlockNextVideo() {  
        const activeVideo = document.querySelector(".video-item.active");  
        const nextVideo = activeVideo?.nextElementSibling;  
  
        if (nextVideo) {  
            nextVideo.classList.remove("locked");  
        }  
        checkCompletion(); // Periksa apakah semua video telah selesai  
    }  
  
    // Fungsi untuk menandai kursus selesai dan mengaktifkan sertifikat  
    function checkCompletion() {  
        const lockedVideos = document.querySelectorAll(".video-item.locked");  
        if (lockedVideos.length === 0) {  
            certificateButton.disabled = false;  
        }  
    }  
  
    // Logika untuk setiap video  
    videoItems.forEach((item) => {  
        item.addEventListener("click", () => {  
            console.log("Video item clicked:", item); // Debugging  
            if (!item.classList.contains("locked")) {  
                updateVideo(item);  
            }  
        });  
    });  
  
    // Logika kuis  
    document.querySelectorAll(".quiz-btn").forEach((button) => {  
        button.addEventListener("click", (e) => {  
            const quizContainer = e.target.closest(".quiz-container");  
            const quizAnswerInput = quizContainer.querySelector("input[type='text']");  
            const quizFeedback = quizContainer.querySelector(".quiz-feedback");  
  
            // Ambil pertanyaan  
            const question = quizContainer.querySelector("h3").textContent;  
            console.log("Question:", question); // Debugging  
  
            // Jawaban yang benar berdasarkan pertanyaan  
            let correctAnswers;  
  
            // Soal 1: Apa itu HTML?  
            if (question.includes("Apa itu HTML?")) {  
                correctAnswers = ["hypertext", "hypertext markup language"];  
  
            // Soal 2: Apa saja alat yang diperlukan untuk memulai pengembangan web?  
            } else if (question.includes("Apa saja alat yang diperlukan untuk memulai pengembangan web?")) {  
                correctAnswers = ["editor teks", "browser", "editor", "alat pengembangan web"];  
  
            // Soal 3: Struktur HTML apa saja?  
            } else if (question.includes("Struktur HTML apa saja?")) {  
                correctAnswers = ["html", "head", "body"];  
  
            // Soal 4: Apa singkatan dari HTML?  
            } else if (question.includes("Apa singkatan dari HTML?")) {  
                correctAnswers = ["hypertext markup language"];  
  
            // Pertanyaan tidak dikenal  
            } else {  
                correctAnswers = [];  
            }  
  
            // Validasi jawaban  
            const userAnswer = quizAnswerInput.value.trim().toLowerCase();  
            const isCorrect = correctAnswers.some((answer) => userAnswer.includes(answer));  
  
            if (isCorrect) {  
                quizFeedback.textContent = "Jawaban benar! Anda bisa melanjutkan ke video berikutnya.";  
                quizFeedback.classList.remove("incorrect");  
                quizFeedback.classList.add("correct");  
                unlockNextVideo(); // Buka video berikutnya  
            } else {  
                quizFeedback.textContent = "Jawaban salah, coba lagi.";  
                quizFeedback.classList.remove("correct");  
                quizFeedback.classList.add("incorrect");  
            }  
        });  
    });  
  
    // Logika untuk mengunduh sertifikat  
    certificateButton.addEventListener("click", () => {  
        if (!certificateButton.disabled) {  
            alert("Sertifikat Anda sedang diunduh!");  
            window.location.href = "/certificates/your-certificate.pdf"; // Ganti dengan URL sertifikat  
        }  
    });  
});  
