<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{use HasFactory;

    protected $fillable = ['name', 'supervisor_id'];

    // Relationship with students
    public function students()
    {
        return $this->belongsToMany(User::class, 'group_student', 'group_id', 'student_id');
    }

    // Relationship with supervisor (belongs to a single supervisor)
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // Relationship with concepts
    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

  

     
    public function proposals()
{
    return $this->hasMany(Proposal::class);
}
    
public function reports()
{
    return $this->hasMany(Report::class);
}


}
