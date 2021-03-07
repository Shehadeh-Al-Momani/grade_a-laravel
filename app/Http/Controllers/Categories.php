<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class Categories extends Controller
{

    // View all categories
    public function index()
    {
        // ORM 
        $categories = Category::all();
        return $categories;
    }

    // View courses by category
    public function show($id)
    {
        // ORM 
        $courses = DB::table('categories')
            ->join('courses', 'courses.category_id', '=', 'categories.id')
            ->where('courses.category_id', $id)
            ->get();

        // $courses = Course::find($id)->courses();

        return $courses;
    }
}