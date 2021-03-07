<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id',
        'credentials',
        'adress',
        'phone',
        'role_id',
        'created_at',
        'isDisabled',
        'isLoggedIn',
      ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';
     
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id','id');
    }
    
    public function rating()
    {
        return $this->hasMany(Rating::class, 'student_id','id');
    }
    
    public function registration()
    {
        return $this->hasMany(Registration::class, 'student_id','id');
    }
    
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id','id');
    }

}