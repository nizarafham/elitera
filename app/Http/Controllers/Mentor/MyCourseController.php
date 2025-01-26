<?php

namespace App\Http\Controllers\Mentor;

use App\Models\Course;
use App\Models\User;
use App\Models\Material;
use App\Models\Video;
use App\Models\PendingCourse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PendingEditCourse;

class MyCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('mentor_id', auth()->id())->paginate(10);
        return view('mentor.mycourse', compact('courses'));
    }

    public function create()
    {
        $videoUrls = [];
        return view('mentor.create', compact('videoUrls'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'level' => 'required|integer|between:1,3',
            'material_title' => 'required|string|max:255',
            'material_description' => 'required|string',
            'material_file' => 'required|mimes:pdf|max:10240',
            'video_titles' => 'array',
            'video_urls' => 'array',
            'quiz_questions' => 'array',
            'quiz_options' => 'array',
            'quiz_answers' => 'array',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('courses', 'public');
            $imageUrl = Storage::url($path);
        }

        $filePath = $request->file('material_file')->store('materials', 'public');
        $videoData = [];
        $quizData = [];

        if (isset($validated['video_titles']) && isset($validated['video_urls'])) {
            foreach ($validated['video_titles'] as $index => $videoTitle) {
                $videoUrl = $validated['video_urls'][$index];
                
                $videoData[] = [
                    'title' => $videoTitle,
                    'url' => $videoUrl
                ];
    
                if (isset($validated['quiz_questions'][$index])) {
                    foreach ($validated['quiz_questions'][$index] as $quizIndex => $question) {
                        $quizData[] = [
                            'video_index' => $index,
                            'question' => $question,
                            'options' => explode("\n", $validated['quiz_options'][$index][$quizIndex]),
                            'correct_answer' => $validated['quiz_answers'][$index][$quizIndex]
                        ];
                    }
                }
            }
        }

        PendingCourse::create([
        'mentor_id' => auth()->id(),
        'course_id' => null,
        'name' => $validated['name'],
        'description' => $validated['description'],
        'sub_description' => $validated['sub_description'],
        'price' => $validated['price'],
        'image_url' => $imageUrl,
        'level' => $validated['level'],
        'material_title' => $validated['material_title'],
        'material_description' => $validated['material_description'],
        'material_file_path' => Storage::url($filePath),
        'video_data' => json_encode($videoData),
        'quiz_data' => json_encode($quizData),
    ]);

        return redirect()->route('mentor.mycourse.index')
            ->with('success', 'Course created successfully. Waiting for admin approval.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('mentor.edit', compact('course'));
    }

    public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'sub_description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'level' => 'required|integer|between:1,3',
        'material_title' => 'required|string|max:255',
        'material_description' => 'required|string',
        'material_file' => 'nullable|mimes:pdf|max:10240',
        'video_titles' => 'array',
        'video_urls' => 'array',
        'quiz_questions' => 'array',
        'quiz_options' => 'array',
        'quiz_answers' => 'array',
    ]);

    $imageUrl = $course->image_url;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = $image->store('courses', 'public');
        $imageUrl = Storage::url($path);
    }

    $filePath = $course->material_file_path;
    if ($request->hasFile('material_file')) {
        $filePath = $request->file('material_file')->store('materials', 'public');
    }

    $videoData = [];
    $quizData = [];
    foreach ($validated['video_titles'] as $index => $videoTitle) {
        $videoData[] = [
            'title' => $videoTitle,
            'url' => $validated['video_urls'][$index] ?? '',
        ];

        if (isset($validated['quiz_questions'][$index])) {
            foreach ($validated['quiz_questions'][$index] as $quizIndex => $question) {
                $quizData[] = [
                    'video_index' => $index,
                    'question' => $question,
                    'options' => explode("\n", $validated['quiz_options'][$index][$quizIndex]),
                    'correct_answer' => $validated['quiz_answers'][$index][$quizIndex],
                ];
            }
        }
    }

    PendingEditCourse::create([
        'mentor_id' => auth()->id(),
        'course_id' => $course->id,
        'name' => $validated['name'],
        'description' => $validated['description'],
        'sub_description' => $validated['sub_description'],
        'price' => $validated['price'],
        'image_url' => $imageUrl,
        'level' => $validated['level'],
        'material_title' => $validated['material_title'],
        'material_description' => $validated['material_description'],
        'material_file_path' => $filePath,
        'video_data' => json_encode($videoData),
        'quiz_data' => json_encode($quizData),
    ]);

    return redirect()->route('mentor.mycourse.index')
        ->with('success', 'Update submitted successfully. Waiting for admin approval.');
}

    public function destroy(Course $mycourse)
{
    if ($mycourse->image_url) {
        $imagePath = str_replace('/storage/', 'public/', $mycourse->image_url);
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath); 
        }
    }

    foreach ($mycourse->videos as $video) {
        if ($video->video_url && Storage::exists($video->video_url)) {
            Storage::delete($video->video_url); 
        }
        $video->delete();
    }

    foreach ($mycourse->materials as $material) {
        if ($material->file_url && Storage::exists($material->file_url)) {
            Storage::delete($material->file_url); 
        }
        $material->delete();
    }

    $mycourse->delete();

    return redirect()->route('mentor.mycourse.index')
        ->with('success', 'Course and related data deleted successfully.');
}

}