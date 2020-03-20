<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $table = 'subject_teachers';

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
