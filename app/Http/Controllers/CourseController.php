<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $value = $request->value;
        $jumlahbaris = 4;

        if (strlen($value)) {
            $courses = Course::where('name', 'like', "%$value%")
                ->with(['mentor' => function ($query) {
                    $query->where('usertype', 'mentor'); // Filter by 'mentor' usertype
                }])
                ->paginate($jumlahbaris);
        } else {
            $courses = Course::orderBy('id', 'desc')
                ->with(['mentor' => function ($query) {
                    $query->where('usertype', 'mentor'); // Ensure only mentors are included
                }])
                ->paginate($jumlahbaris);
        }

        return view('course', compact('courses'));
    }

    public function home()
    {
        $courses = Course::with(['mentor' => function ($query) {
            $query->where('usertype', 'mentor'); // Filter for mentors
        }])->get();
        return view('dashboard', compact('courses'));
    }

    public function topCourses()
    {
        $courses = Course::getTopCourses();
        return view('dashboard', ['courses' => $courses]);
    }

    public function show($id)
    {
        $course = Course::with(['mentor' => function ($query) {
            $query->where('usertype', 'mentor');
        }])->findOrFail($id);

        return view('showcourse', compact('course'));
    }

    public function showMaterials($id)
    {
        // Retrieve the course with its materials
        $course = Course::with(['materials', 'mentor' => function ($query) {
            $query->where('usertype', 'mentor'); // Ensure mentor is valid
        }])->findOrFail($id);

        return view('courses.materials', compact('course'));
    }

    public function myCourses()
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $courses = $user->courses; // Ambil kursus yang telah dibeli oleh user

        return view('course.my_courses', compact('courses'));
    }

}
