<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Course;
use App\Models\Messege;
use App\Models\Rating;
use App\Models\Registration;
use App\Models\Role;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class Instructors extends Controller
{

    // View all instructors
    public function index()
    {
        $instructors = User::where('role_id', 2)->get();
        return $instructors;
    }

    // View one instructor
    public function show($id)
    {
        $instructors = User::whereId($id)->where('role_id', 2)->get();
        return $instructors;
    }

    // View all courses by instructors
    public function getAllCoursesByInstructor($id)
    {
        $sql = 'select c.id courseId ,u.id instructorID,cat.id categoryId,c.name course,
        c.price,c.description,c.img_url img_course,c.created_at,u.name instructor, 
        u.adress,u.email,u.phone,cat.name category,avg(ra.rating_value) rating 
        from courses c 
        join users u ON u.id=c.instructor_id 
        join roles r ON u.role_id=r.id AND r.type LIKE "instructor" 
        join categories cat ON c.category_id =cat.id 
        join rating ra ON ra.course_id=c.id 
        group by ra.course_id 
        Having instructorID =?';
        $courses = DB::select($sql, [$id]);

        return  $courses;
    }
}