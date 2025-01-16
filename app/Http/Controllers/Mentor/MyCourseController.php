<?php

namespace App\Http\Controllers\Mentor;

use App\Models\Course;
use App\Models\User;
use App\Models\Material;
use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('mentor_id', auth()->id())->paginate(10);
        return view('mentor.mycourse', compact('courses'));
    }

    public function create()
    {
        return view('mentor.create');
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
            'is_free' => 'boolean',
            'material_title' => 'required|string|max:255',
            'material_description' => 'required|string',
            'material_file' => 'required|mimes:pdf|max:10240',
            'video_urls' => 'array', // Validasi bahwa ini adalah array
            'video_urls.*' => 'required|url', // Validasi setiap item dalam array adalah URL
            'video_titles' => 'array',
            'video_titles.*' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('courses', 'public');
            $validated['image_url'] = Storage::url($path);
        }
    
        // Menyimpan Course
        $validated['mentor_id'] = auth()->id();
    
        $course = Course::create($validated);

        // Proses penyimpanan file PDF untuk material
        $filePath = $request->file('material_file')->store('materials', 'public');

        // Menyimpan Material
        $material = Material::create([
            'course_id' => $course->id,
            'title' => $validated['material_title'],
            'description' => $validated['material_description'],
            'file_path' => Storage::url($filePath),
        ]);

        // Menyimpan Video URLs
        if (isset($validated['video_urls']) && isset($validated['video_titles'])) {
            foreach ($validated['video_urls'] as $key => $videoUrl) {
                Video::create([
                    'material_id' => $material->id,
                    'video_url' => $videoUrl,
                    'title' => $validated['video_titles'][$key],
                ]);
            }
        }

        return redirect()->route('mentor.mycourse.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit(Course $mycourse)
    {
        return view('mycourses.edit', compact('mycourse'));
    }

    public function update(Request $request, Course $mycourse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'level' => 'required|integer|between:1,3',
            'is_free' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($mycourse->image_url) {
                Storage::delete(str_replace('/storage/', 'public/', $mycourse->image_url));
            }
            
            $image = $request->file('image');
            $path = $image->store('courses', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $validated['is_free'] = $request->has('is_free');
        $mycourse->update($validated);

        return redirect()->route('mycourses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $mycourse)
    {
        if ($mycourse->image_url) {
            Storage::delete(str_replace('/storage/', 'public/', $mycourse->image_url));
        }
        
        $mycourse->delete();

        return redirect()->route('mentor.mycourse.index')
            ->with('success', 'Course deleted successfully.');
    }
}