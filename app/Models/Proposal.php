<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'group_id',
        'concept_id',
        'title',
        'description',
        'pdf_path',
        'status',
        'submitted_by',
        'reviewed_by',
        'supervisor_comments',
        'supervisor_commented_at', 
    ];

    // Relationships
    

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
    public function group()
{
    return $this->belongsTo(Group::class);
}
  public function comments()
    {
        return $this->hasMany(ProposalComment::class);
    }

}
