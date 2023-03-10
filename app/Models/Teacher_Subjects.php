<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_Subjects extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'teacher__subjects';

    protected $fillable = [
        'teacher_id','subject_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
