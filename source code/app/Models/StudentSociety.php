<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentSociety extends Pivot
{
    protected $table = 'student_societies';

    protected $fillable = [
        'student_id',
        'society_id',
        'position_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }
}
