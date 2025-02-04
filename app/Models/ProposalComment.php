<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalComment extends Model
{
    use HasFactory;
    protected $fillable = ['proposal_id', 'supervisor_id', 'comment'];

    // Relationship to Proposal
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    // Relationship to Supervisor (User)
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
