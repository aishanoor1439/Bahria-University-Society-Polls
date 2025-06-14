<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    public $incrementing = true;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function societies()
    {
        return $this->hasMany(StudentSociety::class, 'student_id');
    }

    public function societyMemberships()
    {
        return $this->belongsToMany(Society::class, 'student_societies', 'student_id', 'society_id')
            ->withPivot('position_id')
            ->using(StudentSociety::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'student_id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'student_id', 'student_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'voter_id');
    }

    public function candidacies()
    {
        return $this->hasMany(Candidate::class, 'student_id');
    }

    public function isCandidateInElection($electionId)
    {
        return $this->candidacies()->where('election_id', $electionId)->exists();
    }

    public function hasVotedInElection($electionId)
    {
        return $this->votes()->where('election_id', $electionId)->exists();
    }
}
