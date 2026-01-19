<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $primaryKey = 'vote_id';
    
    protected $fillable = [
        'voter_id',
        'election_id',
        'candidate_id',
    ];

    // Relationship to Voter (Student)
    public function voter()
    {
        return $this->belongsTo(Student::class, 'voter_id');
    }

    // Relationship to Election
    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id');
    }

    // Relationship to Candidate
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}