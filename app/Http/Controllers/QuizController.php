<?php

namespace App\Http\Controllers;  
  
use Illuminate\Http\Request;  
use App\Models\Quiz;  
  
class QuizController extends Controller  
{  
    public function submitAnswer(Request $request)  
    {  
        $videoId = $request->input('video_id');  
        $userAnswer = $request->input('answer');  
  
        // Find the quiz associated with the video  
        $quiz = Quiz::where('video_id', $videoId)->first();  
  
        if (!$quiz) {  
            return response()->json(['status' => 'error', 'message' => 'Quiz not found']);  
        }  
  
        // Check if the answer is correct  
        if (strtolower($quiz->correct_answer) === strtolower($userAnswer)) {  
            return response()->json(['status' => 'success', 'message' => 'jawaban benar, silahkan lanjut ke video berikutnya']);  
        } else {  
            return response()->json(['status' => 'error', 'message' => 'jawaban salah']);  
        }  
    }  
}