<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class MentorController extends Controller
{
    // Menampilkan halaman dashboard mentor
    public function index()
    {
        $user = Auth::user();

        // Mengambil 3 kursus terbaru yang dimiliki mentor
        $courses = Course::where('mentor_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('mentor.listcourse', ['courses' => $courses]);
    }

    // Menampilkan daftar kelas di dashboard mentor (listcourse.blade.php)
    public function dashboard()
    {
        $user = Auth::user();

        // Mengambil semua kursus yang dimiliki mentor
        $classes = Course::where('mentor_id', $user->id)
            ->select('id', 'name') // Sesuaikan nama kolom
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mentor.listcourse', compact('classes'));
    }

    // Menampilkan daftar pelajar berdasarkan kelas tertentu (liststudent.blade.php)
    public function students($classId)
    {
        // Cari kelas berdasarkan ID dan mentor_id
        $course = Course::where('id', $classId)
            ->where('mentor_id', Auth::id())
            ->with('students') // Asumsikan relasi 'students' sudah ada di model Course
            ->first();

        // Jika kursus tidak ditemukan, redirect ke dashboard dengan error
        if (!$course) {
            return redirect()->route('mentor.dashboard')->with('error', 'Kelas tidak ditemukan.');
        }

        // Ambil daftar pelajar untuk kelas tertentu
        $classStudents = $course->students;

        return view('mentor.liststudent', [
            'class' => $course->name,
            'classStudents' => $classStudents
        ]);
    }
}
