<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
     use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'group_id',
        'title',
        'main_objective',
        'other_objectives',
        'description',
        'significance',
        'status',
        'rejection_reason',
        'admin_feedback',
        'keywords',
        'category',
        'is_resubmitted',
        'priority_level',
        'confidentiality_level',
        'attachments',
        'submission_date',
        'review_date',
        'updated_by',
    ];

    /**
     * Relationships
     */
    
    // A concept belongs to a group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // A concept can be updated by a user (admin or other roles)
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope for filtering public concepts.
     */
    public function scopePublic($query)
    {
        return $query->where('confidentiality_level', 'Public')
                     ->where('status', 'Accepted');
    }
}
