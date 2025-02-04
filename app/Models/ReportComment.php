<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportComment extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'supervisor_id', 'comment'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

   
    public function supervisor()
{
    return $this->belongsTo(User::class, 'supervisor_id');
}

}
