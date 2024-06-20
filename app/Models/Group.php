<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade', 'section', 'code', 'tutor_id'
    ];

    public function tutor()
    {
        return $this->belongsTo(Teacher::class, 'tutor_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject_group')
                    ->withPivot('teacher_id')
                    ->withTimestamps();
    }
}
