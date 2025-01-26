<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use App\Models\Video;
use App\Models\User;
use App\Models\Quiz;
use App\Models\VideoProgress;
use Illuminate\Http\Request;
use App\Models\PendingCourse;
use App\Models\PendingEditCourse;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'pending')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function approveCourse($id)
    {
        $pendingCourse = PendingCourse::findOrFail($id);

        // Simpan data course ke tabel courses
        $course = Course::create([
            'mentor_id' => $pendingCourse->mentor_id,
            'name' => $pendingCourse->name,
            'description' => $pendingCourse->description,
            'sub_description' => $pendingCourse->sub_description,
            'price' => $pendingCourse->price,
            'image_url' => $pendingCourse->image_url,
            'level' => $pendingCourse->level,
            'status' => 'approved',
        ]);

        // Simpan material
        $material = Material::create([
            'course_id' => $course->id,
            'title' => $pendingCourse->material_title,
            'description' => $pendingCourse->material_description,
            'file_path' => $pendingCourse->material_file_path,
        ]);

        // Simpan video data dan quiz
        $users = User::all(); 
        $videos = json_decode($pendingCourse->video_data, true) ?? [];
        $quizzes = json_decode($pendingCourse->quiz_data, true) ?? [];

        if ($videos) {
            foreach ($videos as $index => $video) {
                // Simpan video ke database
                $savedVideo = Video::create([
                    'material_id' => $material->id,
                    'video_url' => $video['url'],
                    'title' => $video['title'],
                    'course_id' => $course->id,
                ]);
                
                // Buat VideoProgress untuk setiap pengguna
                foreach ($users as $user) {
                    VideoProgress::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'course_id' => $course->id,
                            'video_id' => $savedVideo->id,
                        ],
                        ['status' => 'started']
                    );
                }

                // Simpan quiz untuk video ini
                $videoQuizzes = array_filter($quizzes, function($quiz) use ($index) {
                    return isset($quiz['video_index']) && $quiz['video_index'] == $index;
                });

                foreach ($videoQuizzes as $quiz) {
                    Quiz::create([
                        'video_id' => $savedVideo->id,
                        'question' => $quiz['question'],
                        'options' => json_encode($quiz['options']),
                        'correct_answer' => $quiz['correct_answer'],
                    ]);
                }
            }
        }

        // Hapus dari pending_courses
        $pendingCourse->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Course approved successfully.');
    }

    public function rejectCourse($id)
    {
        $pendingCourse = PendingCourse::findOrFail($id);
        $pendingCourse->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Course rejected successfully.');
    }
    
    public function approveEditCourse($id)
{
    $pendingEdit = PendingEditCourse::findOrFail($id);

    $course = Course::findOrFail($pendingEdit->course_id);
    $course->update([
        'name' => $pendingEdit->name,
        'description' => $pendingEdit->description,
        'sub_description' => $pendingEdit->sub_description,
        'price' => $pendingEdit->price,
        'image_url' => $pendingEdit->image_url,
        'level' => $pendingEdit->level,
    ]);

    Material::updateOrCreate(
        ['course_id' => $course->id],
        [
            'title' => $pendingEdit->material_title,
            'description' => $pendingEdit->material_description,
            'file_path' => $pendingEdit->material_file_path,
        ]
    );

    $videos = json_decode($pendingEdit->video_data, true) ?? [];
    $quizzes = json_decode($pendingEdit->quiz_data, true) ?? [];

    foreach ($videos as $index => $video) {
        $savedVideo = Video::updateOrCreate(
            [
                'course_id' => $course->id,
                'video_url' => $video['url'],
            ],
            [
                'title' => $video['title'],
                'material_id' => Material::where('course_id', $course->id)->value('id'),
            ]
        );

        $videoQuizzes = array_filter($quizzes, function ($quiz) use ($index) {
            return $quiz['video_index'] == $index;
        });

        foreach ($videoQuizzes as $quiz) {
            Quiz::updateOrCreate(
                [
                    'video_id' => $savedVideo->id,
                    'question' => $quiz['question'],
                ],
                [
                    'options' => json_encode($quiz['options']),
                    'correct_answer' => $quiz['correct_answer'],
                ]
            );
        }
    }

    $pendingEdit->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Edit approved successfully.');
}

    public function getPendingCourses()
    {
        $pendingCourses = PendingCourse::with('mentor')->get(); // Mengambil data dari tabel pending_courses dengan relasi mentor
        return response()->json($pendingCourses);
    }
    public function getPendingEditCourses()
    {
        $pendingEditCourses = PendingEditCourse::with('mentor')->get(); // Ambil data dari tabel yang menyimpan aplikasi edit course yang pending
        return response()->json($pendingEditCourses);
    }

}