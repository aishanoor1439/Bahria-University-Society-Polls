<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;

    protected $primaryKey = 'society_id';
    public $incrementing = true;

    protected $fillable = [
        'society_name',
        'description'
    ];

    public function positions()
    {
        return $this->hasMany(Position::class, 'society_id');
    }

    public function members()
    {
        return $this->hasMany(StudentSociety::class, 'society_id');
    }
}