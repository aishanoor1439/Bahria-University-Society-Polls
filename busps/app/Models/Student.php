<?php
// app/Models/Student.php
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

    public function societyMemberships()
    {
        return $this->belongsToMany(Society::class, 'student_societies', 'student_id', 'society_id')
                    ->withPivot('position_id');
    }
}