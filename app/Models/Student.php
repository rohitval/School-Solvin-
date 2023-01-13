<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name','email', 'student_id_for_subjects', 'status'
    ];
    
    public function subjects()
    {
        return $this->hasMany(Student_Subjects::class);
    }

    public function assignment()
    {
        return $this->belongsTo(StudentAssignment::class);
    }
}
