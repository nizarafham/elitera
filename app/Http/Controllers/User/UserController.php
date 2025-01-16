<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $courses = Course::getTopCourses(); // Dapatkan top courses
        return view('dashboard', ['courses' => $courses]);
    }
}
