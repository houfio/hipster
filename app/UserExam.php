<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $table = 'user_exams';

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'exam_id');
    }
}
