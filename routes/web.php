<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Courses;
use App\Http\Controllers\Categories;
use App\Http\Controllers\Instructors;
use App\Http\Controllers\Ratings;
use App\Http\Controllers\Test;

use App\Models\Category;
use App\Models\Course;
use App\Models\Messege;
use App\Models\Rating;
use App\Models\Registration;
use App\Models\Role;
use App\Models\User;
use App\Models\Video;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/s', function () {
    return view('shehoo');
});

Route::get('/sh7', function () {
    return view('sh7');
});

Route::get('/roles', function () {
    // $users = DB::select('select * from roles');
    $users = Role::all();
    return $users;
    //  return view('sh7');
});

Route::get('/users', function () {
    $users = User::all();
    return $users;
});

Route::get('/users/{id}', function ($id) {
    $users = DB::table('users')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->where('roles.id', $id)
        ->get();

    // $users = User::find($id)->roles;
    return $users;
});

Route::get('/try/{id}', function ($id) {
    $course = Course::find($id)->videos;
    $course = Course::find($id)->rating;
    $course = Course::find($id)->registration;
    $course = Course::find($id)->category;
    $course = Course::find($id)->user;

    $course = Course::find($id)->user;

    // $course = Category::find($id)->courses;
    $course = Course::find($id)->registration;
    $course = User::with(relations: 'roles')->find($id);
    $course = User::find($id)->rating;
    $course = Course::with('category','user','','rating')->find($id);
 
    return $course;
});

// Route::resource('/test', Test::class);
// Route::resource('/courses', [Courses::class]);

/*
|-------------------------------------------------------------------------------
| Students Routes
|-------------------------------------------------------------------------------
 */

Route::resources([
    'test' => Test::class,
    'courses' => Courses::class,
    'categories' => Categories::class,
    'instructors' => Instructors::class,
]);

// Search for courses
Route::get('/search/{id}', [Courses::class, 'searchCourses']);

// Filter courses by rating value
Route::get('/filter/{id}', [Courses::class, 'filterCourses']);

// View student's courses history by students id 
Route::get('/history/{id}', [Courses::class, 'historyCourses']);

// Enrollment in multiple course
Route::get('/add_course/{id}/{i}', [Courses::class, 'enrollmentCourse']); //send request with "student_id" in id params and "course_id" i params

// View all courses instructors categories
Route::get('/allCourses', [Courses::class, 'getAllCoursesInstructorsCategories']);

// Evaluation(Star rating)
Route::post('/evaluate/{c}/{s}/{r}', [Ratings::class, 'evaluate']); //send "course_id" in :c params, "student_id" in :s params, and "rating" in :r params

// Show all rating courses
Route::get('/rating/{id}', [Ratings::class, 'getRating']); // id = "rating_value"

// View all courses by instructors
Route::get('/instructor_courses/{id}', [Instructors::class, 'getAllCoursesByInstructor']); // id=instructor_id 