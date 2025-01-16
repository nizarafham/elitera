<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function pending()
    {
        $pendingCourses = Course::where('status', 'pending')->get();
        return view('admin.courses.pending', compact('pendingCourses'));
    }

    public function approve(Course $course)
    {
        $course->update([
            'status' => 'approved'
        ]);

        // Optional: Kirim notifikasi ke mentor
        return redirect()->back()
            ->with('success', 'Course has been approved.');
    }

    public function reject(Request $request, Course $course)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $course->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason']
        ]);

        // Optional: Kirim notifikasi ke mentor
        return redirect()->back()
            ->with('success', 'Course has been rejected.');
    }
}