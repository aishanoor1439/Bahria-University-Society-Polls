<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Election extends Model
{
    use HasFactory;

    protected $primaryKey = 'election_id';

    protected $fillable = [
        'society_id',
        'election_name',
        'election_year',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id', 'society_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'election_id', 'election_id');
    }
}
