<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{ use HasFactory;

    protected $fillable = [
        'name',
        'department_id', // Add this field
    ];

    // Define the relationship with the Department model
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
