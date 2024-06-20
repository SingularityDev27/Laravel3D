<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname_p', 'lastname_m', 'age', 'degree', 'salary', 'email', 'phone', 'birthdate'
    ];

    public function groups()
    {
        return $this->hasMany(Group::class, 'tutor_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject_group')
                    ->withPivot('group_id')
                    ->withTimestamps();
    }
}
