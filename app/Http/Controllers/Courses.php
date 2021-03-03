<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB;
 use App\Models\Course;


class Courses extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCourses()
    {
        // $sql = 'select * from courses';
        // $courses = DB::select($sql);

        // $courses = DB::table('courses')->get();

        // ORM 
        $courses = Course::all();
        return $courses;
    }

    public function courseDetails($id)
    {
        // $sql = 'select * from courses where id=?';
        // $course = DB::select($sql, [$id]);

        // $course = DB::table('courses')->where('id', $id)->get();

        // ORM 
        $course = Course::where('id', $id)->get();
        return $course;
    }

    public function searchCourses($id)
    {
        // $courses = DB::table('courses')->where('name', 'like', "%{$id}%")->get();

        // ORM 
        $courses = Course::where('name', 'like', "%{$id}%")->get();
        return $courses;
    }

    public function filterCourses($id)
    {
        // $sql = 'select * from courses JOIN rating ON rating.course_id=courses.id AND rating.rating_value > ?';
        // $courses = DB::select($sql,[$id]);
        $courses = DB::table('courses')
            ->join('rating', 'courses.id', '=', 'rating.course_id')
            ->where('rating.rating_value', '>', $id)
            ->get();
        return $courses;
    }

    public function historyCourses($id)
    {
        // $sql = 'select * ,c.id courses_id FROM courses c JOIN registration r ON c.id=r.course_id AND r.student_id=?';
        // $courses = DB::select($sql, [$id]);
        $courses = DB::table('courses AS c')
            ->join('registration AS r', 'c.id', '=', 'r.course_id')
            ->where('r.student_id', $id)
            ->select('*', 'c.id AS courses_id')
            ->get();
        return $courses;
    }

    public function enrollmentCourse($id, $i)
    {
        // $sql = 'insert into registration (student_id, course_id) values (?,?)';
        // $courses = DB::select($sql, [$id, $i]);

        $courses_id = DB::table('registration')->insertGetId(
            ['student_id' => $id, 'course_id' => $i]
        );

        return $courses_id;
    }

    public function getAllCoursesInstructorsCategories()
    {
        //         $sql = ` SELECT c.id courseId ,u.id instructorID,cat.id categoryId,c.name course,c.price,c.description,c.img_url img_course,c.created_at,u.name instructor, u.adress,u.email,u.phone,cat.name category,avg(ra.rating_value) rating 
        //  FROM courses c 
        //  JOIN users u ON u.id=c.instructor_id 
        //  JOIN roles r ON u.role_id=r.id AND r.type LIKE "instructor" 
        //  JOIN categories cat ON c.category_id =cat.id 
        //  JOIN rating ra ON ra.course_id=c.id 
        //  group by ra.course_id`;
        //         $courses = DB::select($sql);

        $courses = DB::table('courses AS c')
            ->join('users AS u', 'u.id', '=', 'c.instructor_id')
            ->join('roles AS r', 'u.role_id', '=', 'r.id')->where('r.type', 'like', "instructor")
            ->join('categories AS cat', 'c.category_id', '=', 'cat.id ')
            ->join('rating AS ra', 'ra.course_id', '=', 'c.id ')
            ->select('c.id as courseId', 'u.id as instructorID', 'cat.id as categoryId', 'c.name as course', 'c.price', 'c.description', 'c.img_url as img_course', 'c.created_at', 'u.name as instructor', 'u.adress', 'u.email', 'u.phone', 'cat.name as category')
            ->groupBy('ra.course_id')
            ->get();
        return $courses;
    }
}