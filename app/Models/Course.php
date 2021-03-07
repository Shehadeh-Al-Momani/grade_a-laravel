<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'instructor_id',
        'img_url',
        'created_at',
        'category_id',
        'isDisabled',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id', 'id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'course_id', 'id');
    }

    public function registration()
    {
        return $this->hasMany(Registration::class, 'course_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }
}