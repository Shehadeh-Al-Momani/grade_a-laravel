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

/*
|-------------------------------------------------------------------------------
| Students Routes
|-------------------------------------------------------------------------------
 */

// View all courses
Route::get('/courses', 'App\Http\Controllers\Courses@getAllCourses');

// View a specific course's details
Route::get('/courses_details/{id}', [Courses::class, 'courseDetails']);

// Search for courses
Route::get('/search/{id}', [Courses::class, 'searchCourses']);

// View all categories
Route::get('/categories', [Categories::class, 'getAllCategories']);

// Filter courses by rating value
Route::get('/filter/{id}', [Courses::class, 'filterCourses']);

// View student's courses history by students id 
Route::get('/history/{id}', [Courses::class, 'historyCourses']);

// Enrollment in multiple course
Route::get('/add_course/{id}/{i}', [Courses::class, 'enrollmentCourse']); //send request with "student_id" in id params and "course_id" i params

// View courses by category
Route::get('/category_courses/{id}', [Categories::class, 'getCategoryCourses']);

// Evaluation(Star rating)
Route::post('/evaluate/{c}/{s}/{r}', [Ratings::class, 'evaluate']); //send "course_id" in :c params, "student_id" in :s params, and "rating" in :r params

// Show all rating courses
Route::get('/rating/{id}', [Ratings::class, 'getRating']); // id = "rating_value"

// View all instructors
Route::get('/instructors/{id}', [Instructors::class, 'getAllInstructors']); // in our project id=2 for instructors

// View all courses by instructors
Route::get('/instructor_courses/{id}', [Instructors::class, 'getAllCoursesByInstructor']); // id=instructor_id 

// View one instructor
Route::get('/instructor_datails/{id}', [Instructors::class, 'getInstructor']); // id=instructor_id 

// View all courses instructors categories
Route::get('/allCourses', [Courses::class, 'getAllCoursesInstructorsCategories']);