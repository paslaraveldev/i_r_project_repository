<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'concept_id',
        'project_type_id',
        'title',
        'description',
        'image',
        'abstract',
        'video_link',
        'pdf_file',
        'status',
        'submitted_by',
        'reviewed_by',
        'supervisor_comments',
        'supervisor_commented_at',
        'revision_needed',
        'confidentiality_level',
        'submission_date',
    ];

    /**
     * Relationships
     */

    // A report belongs to a group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    

    // A report belongs to a concept
    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    // A report belongs to a project type
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    // The user who submitted the report
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    // The supervisor who reviewed the report
    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }


    /**
     * Scope for filtering public reports.
     */
    public function scopePublic($query)
    {
        return $query->where('confidentiality_level', 'Public')
                     ->where('status', 'Ready for Submission');
    }

   public function comments()
{
    return $this->hasMany(ReportComment::class, 'report_id');
}

}
