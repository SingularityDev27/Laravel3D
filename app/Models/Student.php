<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname_p', 'lastname_m', 'age', 'degree', 'email', 'phone', 'birthdate', 'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
