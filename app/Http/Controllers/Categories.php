<?php

namespace App\Http\Controllers;

use App\Models\Category;

class Categories extends Controller
{

    public function getAllCategories()
    {
        // ORM 
        $categories = Category::all();
        return $categories;
    }

    public function getCategoryCourses($id)
    {
        // ORM 
        $category = Category::where('id', $id)->get();
        return $category;
    }
}