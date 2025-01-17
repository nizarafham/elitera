<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\PendingCourse;

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
        'is_free' => $pendingCourse->is_free,
        'status' => 'approved',
    ]);

    // Simpan material
    $material = Material::create([
        'course_id' => $course->id,
        'title' => $pendingCourse->material_title,
        'description' => $pendingCourse->material_description,
        'file_path' => $pendingCourse->material_file_path,
    ]);

    // Simpan video data
    $videos = json_decode($pendingCourse->video_data, true);
    if ($videos) {
        foreach ($videos as $video) {
            Video::create([
                'material_id' => $material->id,
                'video_url' => $video['url'],
                'title' => $video['title'],
            ]);
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
    
    public function getPendingCourses()
    {
        $pendingCourses = PendingCourse::with('mentor')->get(); // Mengambil data dari tabel pending_courses dengan relasi mentor
        return response()->json($pendingCourses);
    }


}