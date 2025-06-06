<?php
// app/Models/Position.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $primaryKey = 'position_id';
    public $incrementing = true;

    protected $fillable = ['society_id', 'position_name'];
}