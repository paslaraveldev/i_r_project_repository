<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     use HasFactory;

    protected $fillable = ['name', 'head_of_department'];

    public function head()
    {
        return $this->belongsTo(User::class, 'head_of_department');
    }
}
