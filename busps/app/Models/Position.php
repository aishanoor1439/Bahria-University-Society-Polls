<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $primaryKey = 'position_id';
    public $incrementing = true;

    protected $fillable = [
        'society_id',
        'position_name'
    ];

    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_societies', 'position_id', 'student_id')
                    ->using(StudentSociety::class);
    }
}