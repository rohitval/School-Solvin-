<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Subjects extends Model
{
    use HasFactory;

    protected $table = 'student__subjects';

    protected $fillable = [
        'student_id','subject_id'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
