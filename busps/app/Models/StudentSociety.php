<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentSociety extends Pivot
{
    protected $table = 'student_societies';

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }
}
