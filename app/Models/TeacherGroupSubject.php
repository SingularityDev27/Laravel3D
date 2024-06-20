<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherGroupSubject extends Model
{
    protected $table = 'teacher_subject_group';
    
    protected $fillable = [
        'teacher_id', 'subject_id', 'group_id'
    ];
}
