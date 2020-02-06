<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'user_exams';

    public function user()
    {
        return $this->hasOne(Exam::class, 'exam_id');
    }

    public function exam()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
