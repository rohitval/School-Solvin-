<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name','email', 'teacher_id_for_subjects', 'status'
    ];
    
    public function subjects()
    {
        return $this->hasMany(Teacher_Subjects::class);
    }

    public function assignment()
    {
        return $this->belongsTo(StudentAssignment::class);
    }

    public function student_count()
    {
        return $this->hasone(StudentAssignment::class)->count();
    }
}
