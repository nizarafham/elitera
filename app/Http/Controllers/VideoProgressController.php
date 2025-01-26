<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoProgress;
use Illuminate\Http\Request;

class VideoProgressController extends Controller
{
    public function track(Request $request, Video $video)
    {
        $progress = VideoProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id' => $video->course_id,
                'video_id' => $video->id,
            ],
            ['status' => 'completed']
        );
        
        return response()->json(['success' => true]);
    }
}