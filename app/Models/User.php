<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'role',
        'registration_number',
        'job_id_number',
        'year_of_entry',
        'course_id',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'year_of_entry' => 'integer',
    ];

    /**
     * Get the course associated with the user (only for students).
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    
   public function groups()
{
    return $this->belongsToMany(Group::class, 'group_student', 'student_id', 'group_id');
}



    public function supervisedGroups()
    {
        return $this->hasMany(Group::class, 'supervisor_id');
    }
    public function group()
{
    return $this->belongsTo(Group::class);
}
public function concepts()
{
    return $this->hasMany(Concept::class);
}




   
}
