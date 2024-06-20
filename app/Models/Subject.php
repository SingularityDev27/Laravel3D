<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'grade', 'name'
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject_group')
                    ->withPivot('group_id')
                    ->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'teacher_subject_group')
                    ->withPivot('teacher_id')
                    ->withTimestamps();
    }
}
