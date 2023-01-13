<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'student_assignments';

    protected $fillable = [
        'teacher_id','subject_id', 'teacher_referenceid', 'status'
    ];
    
    public function teacher()
    {
        return $this->hasone(Teacher::class);
    }

    public function subject()
    {
        return $this->hasone(Subject::class);
    }


}
