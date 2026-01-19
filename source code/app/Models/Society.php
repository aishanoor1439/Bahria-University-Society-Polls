<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;

    protected $table = 'societies';
    protected $primaryKey = 'society_id';
    public $incrementing = true;

    protected $fillable = ['society_name', 'description'];

    public function positions()
    {
        return $this->hasMany(Position::class, 'society_id');
    }

    public function members()
    {
        return $this->belongsToMany(Student::class, 'student_societies', 'society_id', 'student_id')
            ->withPivot('position_id');
    }

    public function elections()
    {
        return $this->hasMany(Election::class, 'society_id');
    }

    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id');
    }
}
