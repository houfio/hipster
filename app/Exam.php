<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_exams', 'user_id');
    }

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }
}
