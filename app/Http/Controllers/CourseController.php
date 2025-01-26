<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\VideoProgress;
use App\Models\Material;
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
                    $query->where('usertype', 'mentor');
                }])
                ->paginate($jumlahbaris);
        } else {
            $courses = Course::orderBy('id', 'desc')
                ->with(['mentor' => function ($query) {
                    $query->where('usertype', 'mentor'); 
                }])
                ->paginate($jumlahbaris);
        }

        return view('course', compact('courses'));
    }

    public function home()
    {
        $courses = Course::with(['mentor' => function ($query) {
            $query->where('usertype', 'mentor'); 
        }])->get();
        return view('dashboard', compact('courses'));
    }

    public function topCourses()
    {
        $courses = Course::getTopCourses();
        return view('dashboard', ['courses' => $courses]);
    }
    public function topCoursesGuest()
    {
        $courses = Course::getTopCourses();
        return view('welcome', ['courses' => $courses]);
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

        $course = Course::with(['materials', 'mentor' => function ($query) {
            $query->where('usertype', 'mentor'); 
        }])->findOrFail($id);

        return view('courses.materials', compact('course'));
    }

    
    public function myCourses() 
    {
        $user = auth()->user(); 
        $courses = $user->courses()->with('mentor')->get();

        return view('course.my_courses', compact('courses'));
    }
    
    public function watch($id)
    {
        $course = Course::with([ 'videos.quiz'])->findOrFail($id);
        $quizData = Quiz::where('video_id')->get();
        $materials = Material::where('course_id', $id)->get();
        $videos = $course->videos->map(function($video) use ($course) {
            $video->progress = VideoProgress::where([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
                'video_id' => $video->id,
                'status' => 'completed'
            ])->exists();
            return $video;
        });

        $firstVideo = $videos->first();

        if (!$firstVideo) {
            $firstVideo = (object) [
                'title' => 'No Video Available',
                'description' => 'No videos have been added to this course yet.',
                'url' => null,
            ];
        }
        return view('course.watch', compact('course', 'videos', 'firstVideo', 'quizData', 'materials'));
    }

    public function try($id)
{
    $course = Course::with(['mentor', 'videos'])->findOrFail($id);

        $videos = $course->videos->map(function($video) use ($course) {
            $video->progress = VideoProgress::where([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
                'video_id' => $video->id,
                'status' => 'completed'
            ])->exists();
            return $video;
        });

        $firstVideo = $videos->first();

        if (!$firstVideo) {
            $firstVideo = (object) [
                'title' => 'No Video Available',
                'description' => 'No videos have been added to this course yet.',
                'url' => null,
            ];
        }

        return view('course.course', compact('course', 'videos', 'firstVideo'));
}

}
