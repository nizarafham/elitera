<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Mentor\MentorController;
use App\Http\Controllers\Mentor\MyCourseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'topCoursesGuest']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function(){

    Route::get('/admin/dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/courses/pending', [AdminCourseController::class, 'pending'])->name('admin.courses.pending');
    Route::post('/admin/courses/{id}/approve', [AdminCourseController::class, 'approveCourse'])->name('admin.courses.approve');
    Route::post('/admin/courses/{id}/reject', [AdminCourseController::class, 'rejectCourse'])->name('admin.courses.reject');
    Route::post('/admin/edit-courses/{id}/approve', [AdminCourseController::class, 'approveEditCourse'])->name('admin.edit-courses.approve');
    Route::get('/admin/courses/json', [AdminCourseController::class, 'getPendingCourses'])->name('admin.courses.json');
    Route::get('/admin/edit-courses/json', [AdminCourseController::class, 'getPendingEditCourses']);
    // Route::get('/admincek', [AdminCourseController::class, ])

});

//user routes
Route::middleware(['auth', 'userMiddleware',])->group(function(){

    Route::post('/transaction/create/{id}', [TransactionController::class, 'createTransaction'])->name('transaction.create');
    Route::get('/courses/{id}/watch', [CourseController::class, 'watch'])->name('courses.watch');
    Route::post('/track-video-progress/{video}', [VideoProgressController::class, 'track'])->name('video.track-progress');
    Route::post('/submit-answer', [QuizController::class, 'submitAnswer']);
    Route::post('/submit-certificate', function (Request $request) {

        return response()->json([
            'status' => 'success',
            'message' => 'Sertifikat berhasil diajukan!'
        ]);
    });
    
    //route percobaan
    // Route::get('/coursetry', [CourseController::class, 'try']);
    // Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');
    Route::get('/get-video-url/{id}', [VideoController::class, 'getVideoUrl']);

});

//mentor routes
Route::middleware(['auth', 'mentorMiddleware'])->group(function () {

    Route::get('/mentor/dashboard', [MentorController::class, 'dashboard'])->name('mentor.dashboard');
    Route::get('/mentor/students/{class}', [MentorController::class, 'students'])->name('mentor.students');
    Route::resource('mycourses', MyCourseController::class)->names('mentor.mycourse');
    
});

//route pengunjung
Route::get('/dashboard',[UserController::class, 'index'])->name('dashboard');
Route::get('/courses',[CourseController::class, 'index'])->name('courses');
Route::get('courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/midtrans/notification', [TransactionController::class, 'handleNotification']);
// root payment
// Route::get('/payment', function () {
//     return view('payment/payment');
// });

// root course


// Route::options('{any}', function () {
//     return response()->json('OK', 200);
// })->where('any', '.*');